<?php

namespace Drupal\comic_panelizer\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Controller for the comic panelizer module.
 */
class ComicPanelizerController extends ControllerBase {

  /**
   * Form to upload comic page.
   */
  public function uploadPage() {
    $form['image'] = [
      '#type' => 'file',
      '#title' => $this->t('Upload Comic Page Image'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * Form submission handler.
   */
  public function uploadPageSubmit(array &$form, FormStateInterface $form_state) {
    // Get the uploaded file.
    $file = $form_state->getValue('image');

    // Process the image, detect panel borders, and save them as separate images.
    $original_path = file_default_scheme() . '://comic_panelizer/' . $file->getClientOriginalName();
    $file->move($original_path);

    // Call a function to process the image.
    $this->processComicPage($original_path);
  }

  /**
   * Process the comic page image.
   */
  private function processComicPage($imagePath) {
    // Load the original image.
    $originalImage = imagecreatefromjpeg($imagePath);

    // Example: Separate panels by detecting horizontal lines.
    $panels = $this->detectPanels($originalImage);

    // Save each panel as a separate image.
    foreach ($panels as $index => $panel) {
      imagejpeg($panel, file_default_scheme() . '://comic_panelizer/panel_' . $index . '.jpg');
    }

    // Clean up resources.
    imagedestroy($originalImage);

    // Display a message to the user.
    drupal_set_message($this->t('Comic page processed successfully.'));
  }

  /**
   * Detect panels by finding horizontal lines.
   */
  private function detectPanels($image) {
    $panels = [];

    // Get image dimensions.
    $width = imagesx($image);
    $height = imagesy($image);

    // Example: Simple horizontal line detection.
    $panelTop = 0;
    for ($y = 0; $y < $height; $y++) {
      $row = [];
      for ($x = 0; $x < $width; $x++) {
        $pixelColor = imagecolorat($image, $x, $y);

        // Example: Check if the pixel is part of a line (adjust threshold as needed).
        $threshold = 100; // Adjust as needed.
        if ($pixelColor < $threshold) {
          $row[] = $pixelColor;
        }
      }

      // If the row has enough dark pixels, consider it a part of a line.
      if (count($row) > $width / 2) {
        // Assume a new panel starts when a line is detected.
        if ($y - $panelTop > 10) { // Adjust the threshold as needed.
          $panels[] = imagecrop($image, ['x' => 0, 'y' => $panelTop, 'width' => $width, 'height' => $y - $panelTop]);
          $panelTop = $y;
        }
      }
    }

    return $panels;
  }
}
