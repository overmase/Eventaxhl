<?php

namespace pocketmine\level\generator\normal\biome;

use pocketmine\block\Sapling;
use pocketmine\level\generator\normal\populator\Flower;
use pocketmine\level\generator\normal\populator\TallGrass;
use pocketmine\level\generator\normal\populator\Tree;

class SavannaBiome extends GrassyBiome
{

    public function __construct()
    {
        parent::__construct();
        $tree = new Tree(Sapling::ACACIA);
        $tree->setBaseAmount(1);
        $tallGrass = new TallGrass();
        $tallGrass->setBaseAmount(20);

        $flower = new Flower();
        $flower->setBaseAmount(4);

        $this->addPopulator($tallGrass);
        $this->addPopulator($tree);
        $this->addPopulator($flower);

        $this->setElevation(62, 68);
        $this->temperature = 1.2;
        $this->rainfall = 0.0;
    }

    public function getName()
    {
        return "Savanna";
    }

}