<?php

namespace App\Story;

use App\GameEngine;
use App\Story\Chapter01\Prolog;
use App\Story\Location\Bakery;
use App\Story\Location\Crossing;
use App\Story\Location\Pharmacy;
use App\Story\Location\School\Cafeteria;
use App\Story\Location\School\ClassRoom;
use App\Story\Location\School\ConferenceRoom;
use App\Story\Location\School\Entrance;
use App\Story\Location\School\GarbagePlace;
use App\Story\Location\School\Gym;
use App\Story\Location\School\Hallway;
use App\Story\Location\School\Playground;
use App\Story\Location\School\SchoolGarden;
use App\Story\Location\School\SchoolOffice;
use App\Story\Location\School\Schoolyard;
use App\Story\Location\School\Shed;
use App\Story\Location\Shop;
use App\Story\Location\Street;
use App\Story\Location\TrainStation;

enum Scene
{
    // neue Cases
    case TRAIN_STATION_PLATFORM;
    case TRAIN_STATION_ENTRANCE;
    case STREET_KIEF;
    case STREET_BAUM;
    case STREET_MOSI;
    case CROSSING_KIEF_MOSI;
    case CROSSING_KIEF_BAUM;
    case CROSSING_BAUM_MOSI;
    case SHOP;
    case PHARMACY;
    case BAKERY;
    case YARD_SOUTH;
    case YARD_NORTH;
    case YARD_TRASH_PLACE;
    case GARDEN_SOUTH;
    case GARDEN_NORTH;
    case GARDEN_EAST;
    case PLAYGROUND;
    case SHED_INT;
    case SHED_EXT;
    case GYM_INT;
    case GYM_EXT;
    case SCHOOL_ENTRANCE;
    case SCHOOL_CAFETERIA;
    case SCHOOL_HALLWAY_SOUTH;
    case SCHOOL_HALLWAY;
    case SCHOOL_HALLWAY_NORTH;
    case SCHOOL_OFFICE;
    case SCHOOL_CLASSROOM;
    case SCHOOL_CONFERENCE_ROOM;
    case PROLOG;
    case EPILOG;
    case EXIT;

    public static function match(Scene &$scene): void
    {
        $scene = match($scene)
        {
            self::TRAIN_STATION_PLATFORM => TrainStation::platform(),
            self::TRAIN_STATION_ENTRANCE => TrainStation::entrance(),
            self::STREET_KIEF => Street::one(),
            self::STREET_BAUM => Street::two(),
            self::STREET_MOSI => Street::three(),
            self::CROSSING_KIEF_MOSI => Crossing::one(),
            self::CROSSING_KIEF_BAUM => Crossing::two(),
            self::CROSSING_BAUM_MOSI => Crossing::three(),
            self::SHOP => Shop::interior(),
            self::PHARMACY => Pharmacy::interior(),
            self::BAKERY => Bakery::interior(),
            self::YARD_SOUTH => Schoolyard::south(),
            self::YARD_NORTH => Schoolyard::north(),
            self::YARD_TRASH_PLACE => GarbagePlace::exterior(),
            self::GARDEN_SOUTH => SchoolGarden::south(),
            self::GARDEN_NORTH => SchoolGarden::north(),
            self::GARDEN_EAST => SchoolGarden::east(),
            self::PLAYGROUND => Playground::basketball(),
            self::SHED_INT => Shed::interior(),
            self::SHED_EXT => Shed::exterior(),
            self::GYM_INT => Gym::interior(),
            self::GYM_EXT => Gym::exterior(),
            self::SCHOOL_ENTRANCE => Entrance::interior(),
            self::SCHOOL_CAFETERIA => Cafeteria::interior(),
            self::SCHOOL_HALLWAY_SOUTH => Hallway::three(),
            self::SCHOOL_HALLWAY => Hallway::two(),
            self::SCHOOL_HALLWAY_NORTH => Hallway::one(),
            self::SCHOOL_OFFICE => SchoolOffice::interior(),
            self::SCHOOL_CLASSROOM => ClassRoom::interior(),
            self::SCHOOL_CONFERENCE_ROOM => ConferenceRoom::interior(),
            self::PROLOG => Prolog::prolog(),
            self::EPILOG => Prolog::end(),
            self::EXIT => Scene::EXIT,

        };
        if($scene == Scene::EXIT) GameEngine::stop();
    }

}
