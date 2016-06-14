<?php
namespace App\Http\Responses;

class ResponseBuilder
{
    /**
     * Builds a response using the view and the given data. It will primarily
     * render the $view file with the $data, but if the request asks for Json
     * A Json response with the same $data will be returned.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $viewData Data that will be passed to the View only, so it will not be visible in Json responses
     *
     * @return Illuminate\Support\Contracts\RenderableInterface a renderable View or Response object
     */
    public function render($view, $data = array(), $viewData = array()) {
        if (Request::isJson() || Request::wantsJson() || Input::get('json', false)) {
            $response = response()->json($this->morphToArray($data));
        } else {
            $response = response()->view($view, array_merge($data, $viewData));
        }

        return $response;
    }

    /**
     * Morph the given content into Array.
     *
     * @param  mixed   $content
     *
     * @return string
     */
    protected function morphToArray($content) {
        if ($content instanceof ArrayableInterface || method_exists($content, 'toArray')) {
            return $content->toArray();
        }

        if (is_array($content)) {
            foreach ($content as $key => $value) {
                $content[$key] = $this->morphToArray($value);
            }
        }

        return $content;
    }

    /**
     * Builds a redirect response to be used when the operation has been performed
     * successfully. Also if the client accepts json, a proper json response will
     * be returned.
     *
     * @param  string  $route
     * @param  array   $data
     * @param  int     $status
     * @param  array   $headers
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectSuccess($route, $data = array(), $status = 302, $headers = array()) {
        if (Request::isJson() || Request::wantsJson() || Input::get('json', false)) {
            $json = ['status' => 'success'];

            if (Session::has('success') &&
                ((strpos($route, 'back') === false) && (strpos($route, 'index') === false))
            ) {
                $data['message'] = Session::get('success');
            }

            $response = App::make('Response')->json($json);
        } else {
            if (isset($data['_old_input'])) {
                Session::flash('_old_input', $data['_old_input']);
                unset($data['_old_input']);
            }

            if ($route == 'back') {
                $response = App::make('redirect')->back($status, $headers);
            } else {
                $response = App::make('redirect')->route($route, $data, $status, $headers);
            }
        }

        return $response;
    }

    /**
     * Builds a redirect response to be used when the operation has failed. Also
     * if the client accepts json, a json containing the error message will be
     * returned.
     *
     * @param  string  $route
     * @param  array   $data
     * @param  int     $status
     * @param  array   $headers
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectFailed($route, $data = array(), $status = 302, $headers = array()) {
        if (Request::isJson() || Request::wantsJson() || Input::get('json', false)) {
            $content = [
                'status' => 'fail',
                'errors' => $this->morphToArray(array_get($data, 'errors')),
            ];

            if (Session::has('error') &&
                ((strpos($route, 'back') === false) && (strpos($route, 'index') === false))
            ) {
                $data['message'] = Session::get('error');
            }

            if (isset($data['_old_input'])) {
                $content['_old_input'] = $data['_old_input'];
            }

            $response = App::make('Response')
                ->json($content);
        } else {
            if (isset($data['_old_input'])) {
                Session::flash('_old_input', $data['_old_input']);
                unset($data['_old_input']);
            }

            if (isset($data['errors'])) {
                Session::flash('errors', $data['errors']);
                unset($data['errors']);
            }

            if ($route == 'back') {
                $response = App::make('redirect')->back($status, $headers);
            } else {
                $response = App::make('redirect')
                    ->route($route, $data, $status, $headers);
            }
        }

        return $response;
    }
}
