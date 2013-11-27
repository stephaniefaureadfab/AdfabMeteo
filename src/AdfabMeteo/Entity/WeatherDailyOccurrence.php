<?php

namespace AdfabMeteo\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity @HasLifecycleCallbacks
 * @ORM\Table(name="weather_daily_occurrence", uniqueConstraints={@UniqueConstraint(name="unique_day_forecast", columns={"date", "city", "forecast"})})
 */
class WeatherDailyOccurrence implements InputFilterAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @ORM\Column(type="integer")
     */
    protected $city;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $minTemperature;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $maxTemperature;

    /**
     * @ORM\Column(type="integer")
     */
    protected $weatherCode;

    /**
     * @ORM\Column(type="boolean")
    */
    protected $forecast;

    /**
     * @param unknown $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param date $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return $date
     */
     public function setDate($date)
     {
        $this->date = $date;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getWeatherCode()
    {
        return $this->weatherCode;
    }

    public function setWeatherCode($weatherCode)
    {
        $this->weatherCode = $weatherCode;
        return $this;
    }

    public function getMinTemperature()
    {
        return $this->minTemperature;
    }

    public function setMinTemperature($minTemperature)
    {
        $this->minTemperature = $minTemperature;
        return $this;
    }

    public function getMaxTemperature()
    {
        return $this->maxTemperature;
    }

    public function setMaxTemperature($maxTemperature)
    {
        $this->maxTemperature = $maxTemperature;
        return $this;
    }

    public function getForecast()
    {
        return $this->forecast;
    }

    public function setForecast($forecast)
    {
        $this->forecast = $forecast;
        return $this;
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate($data = array())
    {
        if (isset($data['city']) && $data['city'] != null) {
            $this->city = $data['city'];
        }
        if (isset($data['weatherCode']) && $data['weatherCode'] != null) {
            $this->weatherCode = $data['weatherCode'];
        }
        if (isset($data['minTemperature']) && $data['minTemperature'] != null) {
            $this->minTemperature = $data['minTemperature'];
        }
        if (isset($data['maxTemperature']) && $data['maxTemperature'] != null) {
            $this->maxTemperature = $data['maxTemperature'];
        }
        if (isset($data['forecast']) && $data['forecast'] != null) {
            $this->forecast = $data['forecast'];
        }
    }

    /**
     * @return the $inputFilter
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            $inputFilter = parent::getInputFilter();

            $inputFilter->add($factory->createInput(array('name' => 'id', 'required' => true, 'filters' => array(array('name' => 'Int'),),)));

            $inputFilter->add($factory->createInput(array(
                'name' => 'date',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty',),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'city',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'forecast',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'minTemperature',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'maxTemperature',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'weatherCode',
                'required' => true,
                'validators' => array(
                    array('name' => 'Digits',),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    /**
     * @param field_type $inputFilter
     */
    public function setInputFilter (InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
}