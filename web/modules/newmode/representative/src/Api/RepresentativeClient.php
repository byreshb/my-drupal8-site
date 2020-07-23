<?php

namespace Drupal\representative\Api;

use Drupal\representative\Dto\RepresentativeDto;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Utility class which uses Guzzle library to retrieve data via REST API.
 *
 * In a typical MVC application with dependency injection, this class will be a singleton service with bunch of other
 * services injected by the container. As this class requires only Guzzle client, this class is made a utility class
 * so it is marked as final and added private constructor so that other classed won't be able to modify the behaviour.
 *
 * Class RepresentativeClient
 * @package Drupal\representative\Api
 */
final class RepresentativeClient
{
  /**
   * API to retrieve representatives by postal code
   */
  private const URI = "http://represent.opennorth.ca/postcodes/{postalCode}/";

  private function __construct()
  {
  }

  /**
   * THis method accepts Postal Code as parameter and returns array of RepresentativeDto.
   * If the Postal Code is invalid or empty, it returns empty array.
   *
   * Empty array is used instead of null as a return value to avoid null pointer exceptions.
   *
   * Noe that this class take input as a string and return output as @RepresentativeDto[] so this can potentially be
   * replaced by another client like guzzle if required.
   *
   * @param string|null $postalCode
   * @return RepresentativeDto[]
   */
  public static function getList(?string $postalCode): array
  {

    // no need to process if the input is empty
    if (empty($postalCode)) {
      return [];
    }

    // API accepts postal code without spaces so removing if there is any
    $sanitizedPostalCode = strtoupper(str_replace(" ", "", trim($postalCode)));

    try {

      // API call to opennorth to retrieve represent information
      $content = \Drupal::httpClient()
        ->request('GET', strtr(self::URI, ['{postalCode}' => $sanitizedPostalCode]))
        ->getBody()
        ->getContents();

      if (!empty($content)) {

        // Converting http output string to php object
        $responseObject = json_decode($content);

        // As per the API definition, the output is an array
        if (!empty($responseObject->representatives_centroid) && is_array($responseObject->representatives_centroid)) {

          // Convert API to an object which represent our form
          $objectArray = array_map(function ($item) {
            return new RepresentativeDto(
              $item->name ?? null,
              $item->party_name ?? null,
              $item->district_name ?? null,
              $item->representative_set_name ?? null
            );
          }, $responseObject->representatives_centroid);

          // Sorting API by Representative Set
          usort($objectArray, function (RepresentativeDto $left, RepresentativeDto $right) {
            return strcmp($left->getRepresentativeSetName(), $right->getRepresentativeSetName());
          });

          return $objectArray;
        }
      }

    } catch (GuzzleException $exception) {
      watchdog_exception('representative', $exception);
    }

    return [];
  }
}
