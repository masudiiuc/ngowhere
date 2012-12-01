<?php

namespace ProjectBundle\Bundle\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SystemUserRepository extends EntityRepository
{
    public function save($data)
    {
        if( !is_object($data) ){
            $data['password'] = md5($data['password']);
            unset($data['conf_password']);
            $userEntity = $this->map($data);
        }else{
            $userEntity = $data;
        }


        $this->_em->persist($userEntity);
        $this->_em->flush();

        return $userEntity;
    }

    private function map($data)
    {
        $userEntity = new SystemUser();

        return $this->mapFields($data, $userEntity);
    }

    private function mapFields($data, $entity)
    {
        foreach ($data as $key => $value) {
            $setter = "set" . ucfirst($key);
            $entity->$setter($value);
        }

        $entity->setCreatedAt(new \DateTime("now"));

        return $entity;
    }

    public function delete($userId)
    {
        $userEntity = $this->find(array(
            'id' => $userId
        ));

        if( $userEntity ){
            $this->_em->remove($userEntity);
            $this->_em->flush();
            return true;
        }
        return false;
    }

    public function getByEmail($email)
    {
        return $this->findOneBy(array('username' => $email));
    }
}