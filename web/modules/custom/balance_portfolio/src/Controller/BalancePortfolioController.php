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
    $build['#attached']['drupalSettings']['deckData'] = json_encode($this->getDeckData()[0]);
    $build['#theme'] = 'balance_portfolio';

    return $build;
  }

  /**
   * Return deck.
   */
  public function getDeckData() {
    $route_name = \Drupal::routeMatch()->getRouteName();
    if ($route_name == 'balance_portfolio.balance') {
      $data = [];
      // Get all nodes of the bundle 'project'.
      $projects = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'project']);
      foreach ($projects as $project) {
        $data[] = [
          'pid' => $project->get('field_project_id')?->value,
          'title' => $project->getTitle(),
          'subtitle' => $project->get('field_subtitle')?->value,
          'category' => $this->getCategories($project->get('field_project_category')->referencedEntities()),
          'duration' => $project->get('field_project_duration')?->value,
          'product' => $project->get('field_product')?->value,
          'hero' => $project->get('field_hero')->entity?->get('field_media_image')->entity?->getFileUri(),
          'preview_image' => $project->get('field_preview_image')->entity?->get('field_media_image')->entity?->getFileUri(),
          'problem' => $project->get('field_the_problem')?->value,
          'goal' => $project->get('field_the_goal')?->value,
          'my_role' => $project->get('field_my_role')?->value,
          'responsibilities' => $project->get('field_responsibilities')?->value,
          'research_summary' => $project->get('field_research_summary')?->value,
          'pain_points' => $this->getPainPoints($project->get('field_pain_points')->referencedEntities()),
          'useablity_study_intro' => $project->get('field_usability_study_intro')?->value,
          'usability_study_findings' => $this->getUsabilityStudyFindings($project->get('field_usability_study_findings')->referencedEntities()),
          'personas' => $this->getPersonas($project->get('field_personas')->referencedEntities()),
          'journey_map_intro' => $project->get('field_journey_map_intro')?->value,
          'journey_map_preview' => $project->get('field_journey_map_preview')->entity?->get('field_media_image')->entity?->getFileUri(),
          'journey_map_pdf' => $project->get('field_journey_map_pdf')->entity?->get('field_media_document')->entity?->getFileUri(),
          'wireframes_prototypes' => $this->getWireframesPrototypes($project->get('field_wireframes_and_prototypes')->referencedEntities()),
          'desing_system_intro' => $project->get('field_desing_system_intro')?->value,
          'design_system_image' => $project->get('field_design_system_image')->entity?->get('field_media_image')->entity?->getFileUri(),
          'accessibility_intro' => $project->get('field_accessibility_intro')?->value,
          'acc_considerations' => $this->getAccConsiderations($project->get('field_acc_considerations')->referencedEntities()),
          'impact' => $project->get('field_impact')?->value,
          'what_i_learned' => $project->get('field_what_i_learned')?->value,
        ];
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
        'photo' => $persona->get('field_persona_photo')->entity?->get('field_media_image')->entity?->getFileUri(),
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
        $imagePath = $image->entity->get('field_media_image')?->entity->getFileUri();
        $imagePaths[] = $imagePath;
      }
      $data[] = [
        'id' => $wireframePrototype->get('id')->value,
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

}