<?php

interface IVacancySubscriber
{
    public function notify();
    public function addJobSeeker(JobSeeker $jobSeeker);
    public function removeJobSeeker(JobSeeker $jobSeeker);
}

class JobSeeker
{
    public $name;
    public $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}

class PHP_VacancySubscriber implements IVacancySubscriber
{
    private $jobSeekers = [];
    private $jobOffer = [];

    public function addJobSeeker(JobSeeker $jobSeeker)
    {
        $this->jobSeekers[] = $jobSeeker;
        echo "$jobSeeker->name, Вы подписались на вакансии РНР программиста " . PHP_EOL;
    }

    public function removeJobSeeker(JobSeeker $jobSeeker)
    {
        foreach ($this->jobSeekers as $key => $value) {
            if ($value === $jobSeeker) {
                array_splice($this->jobSeekers, $key, 1);
                break;
            }
        }
        echo "$jobSeeker->name, Вы отписались" . PHP_EOL;
    }

    public function notify()
    {
        foreach ($this->jobSeekers as $jobSeeker) {
            echo "$jobSeeker->name, появилась новая вакансия" . PHP_EOL;
        }
    }

    public function getJobOffer()
    {
        return $this->jobOffer;
    }

    public function setJobOffer($jobOffer)
    {
        $this->jobOffer = $jobOffer;
        $this->notify();
    }

}


$subscriber = new PHP_VacancySubscriber();

$jobSeeker1 = new JobSeeker('Владимир', 'mail@gmail.com');
$jobSeeker2 = new JobSeeker('Анастасия', 'mail@yandex.ru');

$subscriber->addJobSeeker($jobSeeker1);
$subscriber->addJobSeeker($jobSeeker2);

$subscriber->setJobOffer(['php-программист']);

$subscriber->removeJobSeeker($jobSeeker1);

$subscriber->notify();
