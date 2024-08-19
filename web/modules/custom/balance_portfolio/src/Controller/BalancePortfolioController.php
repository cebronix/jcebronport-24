<?php

namespace Drupal\balance_portfolio\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the Balance Portfolio module.
 */
class BalancePortfolioController extends ControllerBase {
  /**
   * Generate the deck of work.
   */
  public function buildWorkDeck() {
    $build = [];
    $build['#attached']['drupalSettings']['gameDeck'] = $this->getGameDeck();
    $build['#attached']['drupalSettings']['aboutDeck'] = $this->getAboutDeck();
    $build['#theme'] = 'balance_portfolio';

    return $build;
  }

  /**
   * Return deck.
   */
  public function getGameDeck() {
    $route_name = \Drupal::routeMatch()->getRouteName();
    if ($route_name == 'balance_portfolio.balance') {
      $data = [];
      $projects = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'project']);
      foreach ($projects as $project) {
        $data[] = [
          'pid' => $project->get('field_project_id')?->value,
          'title' => $project->getTitle(),
          'subtitle' => $project->get('field_subtitle')?->value,
          'category' => $this->getCategories($project->get('field_project_category')->referencedEntities()),
          'duration' => $project->get('field_project_duration')?->value,
          'product' => $project->get('field_product')?->value,
          'hero' => str_replace('public:/', '', $project->get('field_hero')->entity?->get('field_media_image')->entity?->getFileUri() ?? ''),
          'preview_image' => str_replace('public:/', '', $project->get('field_preview_image')->entity?->get('field_media_image')->entity?->getFileUri() ?? ''),
          'problem' => $project->get('field_the_problem')?->value,
          'goal' => $project->get('field_the_goal')?->value,
          'my_role' => $project->get('field_my_role')?->value,
          'responsibilities' => $project->get('field_responsibilities')?->value,
          'research_summary' => $project->get('field_research_summary')?->value,
          'pain_points' => $this->getPainPoints($project->get('field_pain_points')->referencedEntities()),
          'usability_study_intro' => $project->get('field_usability_study_intro')?->value,
          'usability_study_findings' => $this->getUsabilityStudyFindings($project->get('field_usability_study_findings')->referencedEntities()),
          'personas' => $this->getPersonas($project->get('field_personas')->referencedEntities()),
          'journey_map_intro' => $project->get('field_journey_map_intro')?->value,
          'journey_map_preview' => str_replace('public:/', '', $project->get('field_journey_map_preview')->entity?->get('field_media_image')->entity?->getFileUri() ?? ''),
          'journey_map_pdf' => str_replace('public:/', '', $project->get('field_journey_map_pdf')->entity?->get('field_media_document')->entity?->getFileUri() ?? ''),
          'wireframes_prototypes' => $this->getWireframesPrototypes($project->get('field_wireframes_and_prototypes')->referencedEntities()),
          'design_system_intro' => $project->get('field_desing_system_intro')?->value,
          'design_system_image' => str_replace('public:/', '', $project->get('field_design_system_image')->entity?->get('field_media_image')->entity?->getFileUri() ?? ''),
          'accessibility_intro' => $project->get('field_accessibility_intro')?->value,
          'acc_considerations' => $this->getAccConsiderations($project->get('field_acc_considerations')->referencedEntities()),
          'impact' => $project->get('field_impact')?->value,
          'what_i_learned' => $project->get('field_what_i_learned')?->value,
        ];
      }
      // Shuffle the deck.
      shuffle($data);

      return $data;
    }
  }

  /**
   * Return the about deck.
   */
  public function getAboutDeck() {
    $route_name = \Drupal::routeMatch()->getRouteName();
    if ($route_name == 'balance_portfolio.balance') {
      $data = [];
      $cards = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'about_card']);
      foreach ($cards as $card) {
        $category = $this->getTaxonomy($card->get('field_about_card_type')?->referencedEntities());
        switch ($category) {
          case 'Certificates and Awards':
            $data['edu_certs_random'][] = [
              'main_title' => $card->getTitle(),
              'category' => $category,
              'certs_awards' => $card->get('field_certificates_and_awards')?->getValue(),
            ];
            break;
          case 'Education':
            $data['edu_certs_random'][] = [
              'main_title' => $card->getTitle(),
              'category' => $category,
              'education' => $card->get('field_about_education')?->value,
            ];
            break;
          case 'Plain Text':
            $data['edu_certs_random'][] = [
              'main_title' => $card->getTitle(),
              'category' => $category,
              'body' => $card->get('field_about_card_body')?->value,
            ];
            break;
          case 'Leveled Data':
            $data[$category][] = [
              'main_title' => $card->getTitle(),
              'category' => $category,
              'leveled_data' => $this->getLeveledData($card->get('field_leveled_data')?->referencedEntities()),
            ];
            break;
          case 'Work Experience':
            $data[$category][] = [
              'main_title' => $card->getTitle(),
              'category' => $category,
              'work_experience' => $this->getWorkExperience($card->get('field_work_experience')?->referencedEntities()),
            ];
            break;
          default:
            $data[] = [
              'main_title' => $card->getTitle(),
            ];
            break;
        }
      }
      return $data;
    }
  }

  /**
   * Return the categories.
   */
  public function getCategories($categories) {
    $data = [];
    foreach ($categories as $category) {
      $data[] = [
        'id' => $category->get('tid')?->value,
        'name' => $category->get('name')?->value,
      ];
    }
    return $data;
  }

  /**
   * Return a single Taxonomy.
   */
  public function getTaxonomy($taxonomies) {
    $data = '';
    foreach ($taxonomies as $taxonomy) {
      $data = $taxonomy->get('name')?->value;
    }
    return $data;
  }

  /**
   * Return the pain points.
   */
  public function getPainPoints($painPoints) {
    $data = [];
    foreach ($painPoints as $painPoint) {
      $data[] = [
        'id' => $painPoint->get('id')?->value,
        'name' => $painPoint->get('field_name')[0]?->value,
        'description' => $painPoint->get('field_description')[0]?->value,
      ];
    }
    return $data;
  }

  /**
   * Return the usability study findings.
   */
  public function getUsabilityStudyFindings($usabilityStudyFindings) {
    $data = [];
    foreach ($usabilityStudyFindings as $usabilityStudyFinding) {
      $findings = $usabilityStudyFinding->get('field_use_study_finding')?->getValue();
      $findings = array_map(function ($item) {
        return $item['value'];
      }, $findings);
      $data[] = [
        'id' => $usabilityStudyFinding->get('id')?->value,
        'round' => $usabilityStudyFinding->get('field_use_study_finding_round')[0]?->value,
        'findings' => $findings,
      ];
    }
    return $data;
  }

  /**
   * Return the personas.
   */
  public function getPersonas($personas) {
    $data = [];
    foreach ($personas as $persona) {
      $data[] = [
        'id' => $persona->get('id')?->value,
        'name' => $persona->get('field_persona_name')[0]?->value,
        'quote' => $persona->get('field_persona_quote')[0]?->value,
        'description' => $persona->get('field_persona_description')[0]?->value,
        'goals' => $persona->get('field_persona_goals')[0]?->value,
        'frustrations' => $persona->get('field_persona_frustrations')[0]?->value,
        'age' => $persona->get('field_persona_age')[0]?->value,
        'job' => $persona->get('field_persona_job')[0]?->value,
        'hometown' => $persona->get('field_hometown')[0]?->value,
        'education' => $persona->get('field_persona_education')[0]?->value,
        'family' => $persona->get('field_persona_family')[0]?->value,
        'photo' => str_replace('public:/', '', $persona->get('field_persona_photo')->entity?->get('field_media_image')->entity?->getFileUri() ?? ''),
      ];
    }
    return $data;
  }

  /**
   * Return the wireframes and prototypes.
   */
  public function getWireframesPrototypes($wireframesPrototypes) {
    $data = [];
    foreach ($wireframesPrototypes as $wireframePrototype) {
      $images = $wireframePrototype->get('field_wire_proto_images');
      $imagePaths = [];
      foreach ($images as $image) {
        $imagePath = str_replace('public:/', '', $image->entity->get('field_media_image')?->entity->getFileUri() ?? '');
        $imagePaths[] = $imagePath;
      }
      $data[] = [
        'id' => $wireframePrototype->get('id')->value,
        'round' => $wireframePrototype->get('field_design_round')[0]?->value,
        'title' => $wireframePrototype->get('field_persona_title')[0]?->value,
        'intro' => $wireframePrototype->get('field_wire_proto_intro')[0]?->value,
        'highlights' => $wireframePrototype->get('field_wiref_proto_highlights')[0]?->value,
        'link_text' => $wireframePrototype->get('field_wire_proto_link')[0]?->title,
        'link_uri' => $wireframePrototype->get('field_wire_proto_link')[0]?->uri,
        'images' => $imagePaths,
      ];
    }
    return $data;
  }

  /**
   * Return the accessibility considerations.
   */
  public function getAccConsiderations($accConsiderations) {
    $data = [];
    foreach ($accConsiderations as $accConsideration) {
      $data[] = [
        'id' => $accConsideration->get('id')->value,
        'consideration' => $accConsideration->get('field_consideration')[0]?->value,
      ];
    }
    return $data;
  }

  /**
   * Return the leveled data.
   */
  public function getLeveledData($leveledDataSet) {
    $data = [];
    foreach ($leveledDataSet as $leveledData) {
      $data = [
        'id' => $leveledData->get('id')->value,
        'category' => $this->getTaxonomy($leveledData->get('field_category')->referencedEntities()),
        'title' => $leveledData->get('field_leveled_data_name')[0]?->value,
        'level' => $this->getTaxonomy($leveledData->get('field_leveled_category_level')->referencedEntities()),
      ];
    }
    return $data;
  }

  /**
   * Return the work experience.
   */
  public function getWorkExperience($workExperienceSet) {
    $data = [];
    foreach ($workExperienceSet as $workExperience) {
      $data = [
        'id' => $workExperience->get('id')->value,
        'title' => $workExperience->get('field_work_exp_title')[0]?->value,
        'duration' => $workExperience->get('field_work_exp_duration')[0]?->value,
        'body' => $workExperience->get('field_work_exp_body')[0]?->value,
        'division_work' => $this->getDivisionOfWork($workExperience->get('field_division_of_work')->referencedEntities()),
      ];
    }
    return $data;
  }

  /**
   * Return the division of work.
   */
  public function getDivisionOfWork($divisionOfWorkSet) {
    $data = [];
    foreach ($divisionOfWorkSet as $divisionOfWork) {
      $data[] = [
        'id' => $divisionOfWork->get('id')->value,
        'category' => $this->getTaxonomy($divisionOfWork->get('field_division_of_work_category')->referencedEntities()),
        'percentage' => $divisionOfWork->get('field_division_percentage')[0]?->value,
      ];
    }
    return $data;
  }
}