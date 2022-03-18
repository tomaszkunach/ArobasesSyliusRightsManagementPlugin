<?php
declare(strict_types=1);


namespace Arobases\SyliusRightsManagementPlugin\Command;


use Arobases\SyliusRightsManagementPlugin\Adapter\RightAdapter;
use Arobases\SyliusRightsManagementPlugin\Entity\Right;
use Arobases\SyliusRightsManagementPlugin\Entity\RightGroup;
use Arobases\SyliusRightsManagementPlugin\Repository\Group\RightGroupRepository;
use Arobases\SyliusRightsManagementPlugin\Repository\Right\RightRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAdminRightCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'arobases:right:create-admin-right';
    protected EntityManagerInterface $manager;
    protected RightAdapter $rightAdapter;
    protected RightGroupRepository $groupRightRepository;
    protected RightRepository $rightRepository;


    public function __construct(EntityManagerInterface $manager, RightAdapter $rightAdapter, RightGroupRepository $groupRightRepository, RightRepository $rightRepository)
    {
        $this->manager = $manager;
        $this->rightAdapter = $rightAdapter;
        $this->groupRightRepository = $groupRightRepository;
        $this->rightRepository = $rightRepository;
        parent::__construct();
    }


    protected function configure(): void
    {
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $arrayRights = $this->rightAdapter->getRightsFromYaml();

        foreach($arrayRights as $group => $value) {
            /** @var RightGroup $rightGroup */
            $rightGroup = $this->groupRightRepository->findOneBy(['name' => $group]);
            if ($rightGroup === null) {
                $rightGroup = new RightGroup();
                $rightGroup->setName($group);
                $this->manager->persist($rightGroup);
                $this->manager->flush();
            }

            if ($value === null) {
                continue;
            }
            $right = $this->rightRepository->findOneBy(['name' => $value['name']]);

            if ($right === null) {


                $right = new Right();
                $right->setName($value['name']);
                $right->setRoutes($value['routes']);
                $right->setRedirectTo($value['redirect_to']);
                $right->setExcludedRoutes($value['excludes']);
                $right->setRightGroup($rightGroup);

                $this->manager->persist($right);
            }

        }
            $this->manager->flush();



        return 1;
    }
}
