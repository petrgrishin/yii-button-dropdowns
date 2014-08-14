<?php
/**
 * @var \PetrGrishin\View\View $this
 * @author Petr Grishin <petr.grishin@grishini.ru>
 */
use PetrGrishin\ButtonDropdowns\ButtonDropdownsAction;
use PetrGrishin\HtmlTag\HtmlTag;

$group = HtmlTag::create(HtmlTag::TAG_DIV)->addClass('btn-group')->begin();

$button = HtmlTag::create('button')
    ->addAttr('id', $containerId = $this->getUniqueIdentifier('container'))
    ->addAttr('data-toggle', 'dropdown')
    ->addClass('btn dropdown-toggle')
    ->setContent(sprintf('%s <span class="caret"></span>', $this->getParam('title')));

if ($type = $this->getParam('type', false)) {
    $button->addClass(sprintf('btn-%s', $type));
}

$button->run();

$menu = HtmlTag::create('ul')
    ->addClass('dropdown-menu')
    ->addAttr('role', 'menu')
    ->begin();

/** @var ButtonDropdownsAction $action */
foreach ($this->getParam('actions') as $action) {
    $item = HtmlTag::create('li')->begin();
    $link = HtmlTag::create('a')
        ->setContent($action->getName())
        ->run();
    $item->end();
}

$menu->end();

$group->end();

