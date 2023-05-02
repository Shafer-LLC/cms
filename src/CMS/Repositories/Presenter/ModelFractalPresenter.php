<?php

namespace Dply\CMS\Repositories\Presenter;

use Exception;
use Dply\CMS\Repositories\Transformer\ModelTransformer;
use Dply\CMS\Repositories\Presenter\FractalPresenter;

/**
 * Class ModelFractalPresenter
 *
 * @package Prettus\Repository\Presenter
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class ModelFractalPresenter extends FractalPresenter
{

    /**
     * Transformer
     *
     * @return ModelTransformer
     * @throws Exception
     */
    public function getTransformer()
    {
        if (!class_exists('League\Fractal\Manager')) {
            throw new Exception("Package required. Please install: 'composer require league/fractal' (0.12.*)");
        }

        return new ModelTransformer();
    }
}
