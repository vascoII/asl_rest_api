<?php

namespace Fds\AslMongoBundle\Form;

class LocationForm extends \Symfony\Component\Form\Form
{
    public function configure()
    {
        $this->add(new TextField('locationName', array('max_length' => 255, 'required' => true)));
    }

    public function addTerminals($dm)
    {
        $this->add(new ChoiceField('terminals.0.terminalName', array('choices' => $dm)));
        $this->add(new DateField('terminals.0.since', array('required' => true, 'type'=> 'timestamp')));
        $this->add(new DateField('terminals.0.to', array('required' => false, 'type' => 'timestamp')));
    }
}

