<?php

namespace App\Console\Commands;

use App\Card;
use App\User;
use App\Station;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class installSubwayPass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SubwayPass:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install defaults for the system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::transaction(function () {
            $this->setStations();
            $this->createTestUser();
        });
    }

    public function setStations()
    {
        $station = new Station();

        foreach (config('installationConfig.stations') as $defaultStation){
            $station->createNew($defaultStation);
        }
        $this->info("Created all the station and their zones");
        return ;
    }

    public function createTestUser()
    {
        $user = new User();
        $card = new Card();
        $newUser = $user->createNew(config('installationConfig.test_user'));
        $this->info("Created a new test user with the firstname '" .$newUser["firstname"]. "'" );
        $cardNo = createCardNo($newUser["firstname"], $newUser["lastname"]);
        $newCardData = [
            "user_id" => $newUser["id"],
            "card_no" => $cardNo,
            "amount" => 30,
        ];
        $userCards = $card->createNew($newCardData);
        $this->info("Created a new card with card no '".$userCards["card_no"]."' for the new user");
        return ;
    }
}
