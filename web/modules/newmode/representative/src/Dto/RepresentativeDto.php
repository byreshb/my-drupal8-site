<?php

namespace Drupal\representative\Dto;

/**
 * Immutable Data Transfer Object (One of the EIP patterns). Marked as final, no setters, all variables are
 * instantiated in the constructor. If setters are required, make sure to clone to achieve immutability
 *
 * This object can be used in twig file or can be serialized to custom JSON using a serializer
 *
 * Class RepresentativeDto
 * @package Drupal\representative\Dto
 */
final class RepresentativeDto
{
  private $name;
  private $partyName;
  private $districtName;
  private $representativeSetName;

  /**
   * RepresentativeDto constructor.
   * @param $name
   * @param $partyName
   * @param $districtName
   * @param $representativeSetName
   */
  public function __construct($name, $partyName, $districtName, $representativeSetName)
  {
    $this->name = $name;
    $this->partyName = $partyName;
    $this->districtName = $districtName;
    $this->representativeSetName = $representativeSetName;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @return mixed
   */
  public function getPartyName()
  {
    return $this->partyName;
  }

  /**
   * @return mixed
   */
  public function getDistrictName()
  {
    return $this->districtName;
  }

  /**
   * @return mixed
   */
  public function getRepresentativeSetName()
  {
    return $this->representativeSetName;
  }
}
