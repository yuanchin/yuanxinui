<?php

namespace Yuanchin\YuanxinUi\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;

abstract class YuanxinUiComponent extends Component
{
    /**
     * Get the evaluated view contents for the given view.
     *
     * @return View
     */
    abstract protected function blade();

    /**
     * With this method, you can handle the abbreviations corresponding to
     * the attributes of your component.
     *
     * @param array $data
     *
     * @return array
     */
    abstract protected function handle(array $data);

    /**
     * Resolve the Blade view or view file that should be used when rendering the component.
     *
     * @return Closure|View
     */
    public function resolveView()
    {
        $view = $this->render();

        if ($view instanceof View) {
            return $view;
        }

        $resolver = fn (View $view) => new HtmlString($view->render());

        return fn (array $data = []) => $resolver($view($data));
    }

    /**
     * Run the final processing of the data for the YuanxinUI component.
     *
     * @param array $data
     *
     * @return array
     */
    protected function runYuanxinUiComponent(array $data)
    {
        $data = $this->handle($data);

        return $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Closure
     */
    public function render()
    {
        return fn (array $data = []) => $this->blade()->with(
            $this->runYuanxinUiComponent($data)
        );
    }
}
