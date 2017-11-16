<?php

class R extends Kint_Renderer_Rich
{
    public static $preRenderOutput;

    public function preRender()
    {
        if (!self::$preRenderOutput) {
            return self::$preRenderOutput = parent::preRender();
        }

        return parent::preRender();
    }
}

    Kint::$renderers[Kint::MODE_RICH] = 'R';
