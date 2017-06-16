<?php

class Application_Model_Race
{
    protected $_nom;
    protected $_espece_id;
    protected $_description;
    protected $_prix;
    protected $_id;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid race property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid race property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setNom($nom)
    {
        $this->_nom = (string) $nom;
        return $this;
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function setEspece_Id($espece_id)
    {
        $this->_espece_id = (int) $espece_id;
        return $this;
    }

    public function getEspece_Id()
    {
        return $this->_espece_id;
    }

    public function setDescription($description)
    {
        $this->_description = (string) $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setPrix($prix)
    {
        $this->_prix = (string) $prix;
        return $this;
    }

    public function getPrix()
    {
        return $this->_prix;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
}

