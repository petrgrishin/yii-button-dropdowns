<?php
/**
 * @author Petr Grishin <petr.grishin@grishini.ru>
 */

namespace PetrGrishin\ButtonDropdowns;


use PetrGrishin\ButtonDropdowns\Exception\ButtonDropdownsWidgetException;
use PetrGrishin\Widget\BaseWidget;

class ButtonDropdownsWidget extends BaseWidget {
    const TYPE_DEFAULT = 'default';
    const TYPE_PRIMARY = 'primary';
    const TYPE_SUCCESS = 'success';
    const TYPE_INFO = 'info';
    const TYPE_WARNING = 'warning';
    const TYPE_DANGER = 'danger';
    const TYPE_LINK = 'link';

    /** @var string */
    private $title;
    /** @var string */
    private $type;
    /** @var ButtonDropdownsAction[] */
    private $actions = array();

    private static $types = array(
        self::TYPE_DEFAULT,
        self::TYPE_PRIMARY,
        self::TYPE_SUCCESS,
        self::TYPE_INFO,
        self::TYPE_WARNING,
        self::TYPE_DANGER,
        self::TYPE_LINK,
    );

    public function run() {
        $this->render('button', array(
            'title' => $this->getTitle(),
            'type' => $this->getType(),
            'actions' => $this->getActions(),
        ));
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getType() {
        return $this->type ?: self::TYPE_DEFAULT;
    }

    public function setType($type) {
        if (false === array_search($type, self::$types)) {
            throw new ButtonDropdownsWidgetException(sprintf('Type `%s` is illegal', $type));
        }
        $this->type = $type;
        return $this;
    }

    /**
     * @return ButtonDropdownsAction
     */
    public function addAction() {
        $action = new ButtonDropdownsAction();
        $this->actions[] = $action;
        return $action;
    }

    /**
     * @return ButtonDropdownsAction[]
     */
    public function getActions() {
        return $this->actions;
    }
}
 