<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\View\Helper;

use CmsCommon\View\Helper\HtmlContainer;

class Panel extends HtmlContainer
{
    /**
     * @var string Default panel class
     */
    protected $defaultClass = 'panel';

    /**@+
     * @var string Templates for the open/close for panel parts tags
     */
    protected $headingCloseTag  = '</div>';
    protected $headingOpenTag   = '<div%s>';
    protected $bodyCloseTag     = '</div>';
    protected $bodyOpenTag      = '<div%s>';
    protected $footerCloseTag   = '</div>';
    protected $footerOpenTag    = '<div%s>';
    /**@-*/

    /**@+
     * @var array Default attributes for panel parts tags
     */
    protected $headingAttributes    = ['class' => 'panel-heading'];
    protected $bodyAttributes       = ['class' => 'panel-body'];
    protected $footerAttributes     = ['class' => 'panel-footer'];
    /**@-*/

    /**
     * @param string $content
     * @param array $attribs
     * @param string $header
     * @param string $footer
     * @return self|string
     */
    public function __invoke($content = null, array $attribs = [], $header = null, $footer = null)
    {
        if (func_num_args() === 0) {
            return $this;
        }

        return $this->render($content, $attribs, $header, $footer);
    }

    /**
     * @param string $content
     * @param array $attribs
     * @param string $header
     * @param string $footer
     * @return string
     */
    public function render($content, array $attribs = [], $header = null, $footer = null)
    {
        $markup = '';

        if ($header) {
            $markup .= sprintf($this->headingOpenTag, $this->htmlAttribs($this->headingAttributes));
            $markup .= $header;
            $markup .= $this->headingCloseTag;
        }

        $markup .= sprintf($this->bodyOpenTag, $this->htmlAttribs($this->bodyAttributes));
        $markup .= $content;
        $markup .= $this->bodyCloseTag;

        if ($footer) {
            $markup .= sprintf($this->footerOpenTag, $this->htmlAttribs($this->footerAttributes));
            $markup .= $footer;
            $markup .= $this->footerCloseTag;
        }

        return parent::render($markup, $attribs);
    }

    /**
     * @param array $attribs
     * @return self
     */
    public function setHeadingAttributes(array $attribs)
    {
        $this->headingAttributes = $attribs;
        return $this;
    }

    /**
     * @param string $openTag
     * @return self
     */
    public function setHeadingOpenTag($openTag)
    {
        $this->headingOpenTag = $openTag;
        return $this;
    }

    /**
     * @param string $closeTag
     * @return self
     */
    public function setHeadingCloseTag($closeTag)
    {
        $this->headingCloseTag = $closeTag;
        return $this;
    }

    /**
     * @param array $attribs
     * @return self
     */
    public function setBodyAttributes(array $attribs)
    {
        $this->bodyAttributes = $attribs;
        return $this;
    }

    /**
     * @param string $openTag
     * @return self
     */
    public function setBodyOpenTag($openTag)
    {
        $this->bodyOpenTag = $openTag;
        return $this;
    }

    /**
     * @param string $closeTag
     * @return self
     */
    public function setBodyCloseTag($closeTag)
    {
        $this->bodyCloseTag = $closeTag;
        return $this;
    }

    /**
     * @param array $attribs
     * @return self
     */
    public function setFooterAttributes(array $attribs)
    {
        $this->footerAttributes = $attribs;
        return $this;
    }

    /**
     * @param string $openTag
     * @return self
     */
    public function setFooterOpenTag($openTag)
    {
        $this->footerOpenTag = $openTag;
        return $this;
    }

    /**
     * @param string $closeTag
     * @return self
     */
    public function setFooterCloseTag($closeTag)
    {
        $this->footerCloseTag = $closeTag;
        return $this;
    }
}
