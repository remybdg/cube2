<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;
use Symfony\Component\Validator\ConstraintViolation;

class AppTest extends KernelTestCase {

    public function getEntity(): User {
        return (new User())
            ->setFirstname('toto')
            ->setLastname('tata')
            ->setUsername('citizen_1@gmail.com')
            ->setUsernameCanonical('citizen_1@gmail.com')
            ->setEmail('citizen_1@gmail.com')
            ->setEmailCanonical('citizen_1@gmail.com')
            ->setEnabled(true)
            ->setPlainPassword('root')
            ->setRoles(['ROLE_CITIZEN']);
            //->setAddress('@address_1');
    }

    public function assertHasErrors(User $user, int $number = 0) {
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($user);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(', ', $messages));
    }
    
    public function testNewUser() {
        $user = $this->getEntity();
        $this->assertHasErrors($user, 0);
    }

    public function testemptyUserFirstname() {
        $emptyString = '';
        $user = $this->getEntity()->setFirstname($emptyString);
        $this->assertHasErrors($user, 1);
    }

    public function testemptyUserLastname() {
        $emptyString = '';
        $user = $this->getEntity()->setLastname($emptyString);
        $this->assertHasErrors($user, 1);
    }

    public function testemptyUsersername() {
        $emptyString = '';
        $user = $this->getEntity()->setUsername($emptyString);
        $this->assertHasErrors($user, 1);
    }

    public function testemptyUsersernameCanonical() {
        $emptyString = '';
        $user = $this->getEntity()->setUsernameCanonical($emptyString);
        $this->assertHasErrors($user, 1);
    }

    public function testemptyUserEmail() {
        $emptyString = '';
        $user = $this->getEntity()->setEmail($emptyString);
        $this->assertHasErrors($user, 1);
    }

    public function testemptyUserEmailCanonical() {
        $emptyString = '';
        $user = $this->getEntity()->setEmailCanonical($emptyString);
        $this->assertHasErrors($user, 1);
    }

    public function testemptyUserEnabled() {
        $emptyString = '';
        $user = $this->getEntity()->setEnabled($emptyString);
        $this->assertHasErrors($user, 1);
    }

    public function testemptyUserPlainPassword() {
        $emptyString = '';
        $user = $this->getEntity()->setPlainPassword($emptyString);
        $this->assertHasErrors($user, 1);
    }

    public function testemptyUserRoles() {
        $emptyString = '';
        $user = $this->getEntity()->setRoles([$emptyString]);
        $this->assertHasErrors($user, 1);
    }
}