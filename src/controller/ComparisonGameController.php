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
use App\Model\UpdateByMemberGameManager;
use App\Model\UpdateByMemberDeveloperManager;
use App\Model\UpdateByMemberGenreManager;
use App\Model\UpdateByMemberModeManager;
use App\Model\UpdateByMemberReleaseDateManager;
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

            // Get the original game
            $gameManager = new GameManager();
            $game = $gameManager->getGame($game_id);

            $developerManager = new DeveloperManager();
            $developers = $developerManager->getDevelopers($game_id);

            $genreManager = new GenreManager();
            $genres = $genreManager->getGenres($game_id);

            $modeManager = new ModeManager();
            $modes = $modeManager->getModes($game_id);

            // Get releases for a game with platforms, regions and publishers
            $releaseDateManager = new ReleaseDateManager();
            $releaseDates = $releaseDateManager->getReleases($game_id);

            // Get the updated game
            $updateByMemberGameManager = new UpdateByMemberGameManager();
            $gameUpdatedByMember = $updateByMemberGameManager->getGameUpdatedByMember($game_id);

            // Check if an updated cover is registered
            $gameUpdatedCover = $gameUpdatedByMember->getCover_extension();

            $updateByMemberDeveloperManager = new UpdateByMemberDeveloperManager();
            $developersUpdatedByMember = $updateByMemberDeveloperManager->getDevelopersUpdatedByMember($game_id);

            $updateByMemberGenreManager = new UpdateByMemberGenreManager();
            $genresUpdatedByMember = $updateByMemberGenreManager->getGenresUpdatedByMember($game_id);

            $updateByMemberModeManager = new UpdateByMemberModeManager();
            $modesUpdatedByMember = $updateByMemberModeManager->getModesUpdatedByMember($game_id);

            $updateByMemberReleaseDateManager = new UpdateByMemberReleaseDateManager();
            $releasesUpdatedByMember = $updateByMemberReleaseDateManager->getReleasesUpdatedByMember($game_id);

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