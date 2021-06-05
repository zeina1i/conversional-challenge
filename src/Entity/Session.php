<?php


namespace App\Entity;


class Session
{
    /** @var int $id */
    private $id;
    /** @var User $user */
    private $user;
    /** @var \DateTime $appointmentTime */
    private $appointmentTime;
    /** @var \DateTime $activationTime */
    private $activationTime;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return \DateTime
     */
    public function getAppointmentTime(): \DateTime
    {
        return $this->appointmentTime;
    }

    /**
     * @param \DateTime $appointmentTime
     */
    public function setAppointmentTime(?\DateTime $appointmentTime): void
    {
        $this->appointmentTime = $appointmentTime;
    }

    /**
     * @return \DateTime
     */
    public function getActivationTime(): \DateTime
    {
        return $this->activationTime;
    }

    /**
     * @param \DateTime $activationTime
     */
    public function setActivationTime(?\DateTime $activationTime): void
    {
        $this->activationTime = $activationTime;
    }
}