<?php

/*
 * This file is part of [mindbird/contao-ce-box].
 *
 * (c) mindbird
 *
 * @license LGPL-3.0-or-later
 */

namespace Mindbird\Contao\CEBox\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\FilesModel;
use Contao\StringUtil;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Box extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        $template->headline = $model->headline;
        $template->text = $model->text;
        $template->slogan = $model->slogan;

        $file = FilesModel::findByPk($model->image);
        if (null !== $file) {
            Template::addImageToTemplate($template, [
                'singleSRC' => $file->path,
                'size' => StringUtil::deserialize($model->imgSize),
            ]);
        }

        return $template->getResponse();
    }
}
