<?php

namespace ProjectBundle\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    private $countries;
    private $roles;
    private $status;

    public function __construct($countries = array(), $role)
    {
        $this->countries = $countries;

        if ($role == 'super-admin') {
            $this->roles = array(
                'super-admin' => 'Super Admin',
                'operator-admin' => 'Operator Admin',
                'operator-support' => 'Operator Support',
                'operator-security' => 'Operator Security',
                'operator-bank' => 'Operator Bank'
            );
        } else {
            $this->roles = array(
                'operator-support' => 'Operator Support',
                'operator-security' => 'Operator Security',
                'operator-bank' => 'Operator Bank'
            );
        }


        $this->status = array(
            'active' => 'Active',
            'inactive' => 'inactive'
        );
    }


    public function getName()
    {
        return 'user';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('role', 'choice', array(
            'choices' => $this->roles,
            'required' => true
        ));

        $builder->add('firstName', 'text', array(
            'required' => true
        ));

        $builder->add('lastName', 'text', array(
            'required' => true
        ));

        $builder->add('username', 'text', array(
            'required' => true
        ));

        $builder->add('password', 'password', array(
            'required' => true
        ));

        $builder->add('conf_password', 'password', array(
            'required' => true
        ));

        $builder->add('address', 'text', array(
            'required' => false
        ));

        $builder->add('street', 'text', array(
            'required' => false
        ));

        $builder->add('apartment', 'text', array(
            'required' => false
        ));

        $builder->add('country', 'choice', array(
            'choices' => $this->countries,
            'required' => false
        ));

        $builder->add('province', 'text', array(
            'required' => false
        ));

        $builder->add('postalCode', 'text', array(
            'required' => false
        ));

        $builder->add('status', 'choice', array(
            'choices' => $this->status,
            'required' => true
        ));

    }
}