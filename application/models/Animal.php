<?php

class Application_Model_Animal
{
    protected $_pere_id;
    protected $_mere_id;
    protected $_race_id;
    protected $_espece_id;
    protected $_commentaires;
    protected $_nom;
    protected $_date_naissance;
    protected $_sexe;
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
            throw new Exception('Invalid animal property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid animal property');
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

    public function setPere_Id($pere_id)
    {
        $this->_pere_id = (string) $pere_id;
        return $this;
    }

    public function getPere_Id()
    {
        return $this->_pere_id;
    }

    public function setMere_Id($mere_id)
    {
        $this->_mere_id = (string) $mere_id;
        return $this;
    }

    public function getMere_Id()
    {
        return $this->_mere_id;
    }

    public function setRace_Id($race_id)
    {
        $this->_race_id = (string) $race_id;
        return $this;
    }

    public function getRace_Id()
    {
        return $this->_race_id;
    }

    public function setEspece_Id($espece_id)
    {
        $this->_espece_id = (string) $espece_id;
        return $this;
    }

    public function getEspece_Id()
    {
        return $this->_espece_id;
    }

    public function setCommentaires($commentaires)
    {
        $this->_commentaires = (string) $commentaires;
        return $this;
    }

    public function getCommentaires()
    {
        return $this->_commentaires;
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

    public function setDate_Naissance($date_naissance)
    {
        $this->_date_naissance = (string) $date_naissance;
        return $this;
    }

    public function getDate_Naissance()
    {
        return $this->_date_naissance;
    }

    public function setSexe($sexe)
    {
        $this->_sexe = (string) $sexe;
        return $this;
    }

    public function getSexe()
    {
        return $this->_sexe;
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

