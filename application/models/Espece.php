<?php

class Application_Model_Espece
{
    protected $_prix;
    protected $_description;
    protected $_nom_latin;
    protected $_nom_courant;
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
            throw new Exception('Invalid espece property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid espece property');
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

    public function setPrix($prix)
    {
        $this->_prix = (string) $prix;
        return $this;
    }

    public function getPrix()
    {
        return $this->_prix;
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

    public function setNom_Latin($nom_latin)
    {
        $this->_nom_latin = (string) $nom_latin;
        return $this;
    }

    public function getNom_Latin()
    {
        return $this->_nom_latin;
    }

    public function setNom_Courant($nom_courant)
    {
        $this->_nom_courant = (string) $nom_courant;
        return $this;
    }

    public function getNom_Courant()
    {
        return $this->_nom_courant;
    }

    public function setId($id)
    {
        $this->_id = (string) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
}

