<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Model\DeveloperManager;
use App\Model\GenreManager;
use App\Model\ModeManager;
use App\Model\PlatformManager;
use App\Model\PublisherManager;
use App\Model\RegionManager;
use App\Model\ReleaseDateManager;
// use App\Model\UpdateByMemberGameManager;
// use App\Model\UpdateByMemberDeveloperManager;
// use App\Model\UpdateByMemberGenreManager;
// use App\Model\UpdateByMemberModeManager;
// use App\Model\UpdateByMemberReleaseDateManager;
use App\Core\View;

/**
 * ComparisonGameController
 * 
 * Allows to show the comparison game page where you can see original and updated game
 */

 class ComparisonGameController
 {
    /**
     * Allows to show the comparison page showing original and updated game
     */
    public function showOriginalAndUpdatedGame($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            $currentMember = null;

            if (isset($_SESSION['currentMember'])) {
                $currentMember = $_SESSION['currentMember'];
            }

            extract($params); // Allows to extract the $id variable

            $game_id = $id; // rename the variable for better identification

            $gameManager = new GameManager();
            $developerManager = new DeveloperManager();
            $genreManager = new GenreManager();
            $modeManager = new ModeManager();
            $releaseDateManager = new ReleaseDateManager();

            // Get the original game
            $game = $gameManager->getGame($game_id);
            $developers = $developerManager->getGameDevelopers($game_id);
            $genres = $genreManager->getGameGenres($game_id);
            $modes = $modeManager->getGameModes($game_id);
            $releaseDates = $releaseDateManager->getGameReleases($game_id);

            // Get the updated game
            $gameUpdatedByMember = $gameManager->getGame($game_id, true);

            // Check if an updated cover is registered
            $gameUpdatedCover = $gameUpdatedByMember->getCover_extension();

            $developersUpdatedByMember = $developerManager->getGameDevelopers($game_id, true);
            $genresUpdatedByMember = $genreManager->getGameGenres($game_id, true);
            $modesUpdatedByMember = $modeManager->getGameModes($game_id, true);
            $releasesUpdatedByMember = $releaseDateManager->getGameReleases($game_id, true);

            $view = new View('gameComparison');
            $view->render('comparison', array(
                'game' => $game, 
                'developers' => $developers,
                'genres' => $genres,
                'modes' => $modes,
                'releases' => $releaseDates,
                'updatedGame' => $gameUpdatedByMember,
                'updatedDevelopers' => $developersUpdatedByMember,
                'updatedGenres' => $genresUpdatedByMember,
                'updatedModes' => $modesUpdatedByMember,
                'updatedReleases' => $releasesUpdatedByMember,
                'updatedCover' => $gameUpdatedCover,
                'member' => $currentMember
            ));

        } else {
            
            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }

    }
 }