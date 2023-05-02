<?php

namespace Dply\Backend\Http\Controllers\Installer;

use Illuminate\Routing\Controller;
use Dply\CMS\Events\InstallerFinished;
use Dply\CMS\Support\Manager\FinalInstallManager;
use Dply\CMS\Support\Manager\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @param FinalInstallManager $finalInstall
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function finish(
        InstalledFileManager $fileManager,
        FinalInstallManager $finalInstall
    ) {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();

        event(new InstallerFinished());

        return view('cms::installer.finished', compact(
            'finalMessages',
            'finalStatusMessage'
        ));
    }
}
