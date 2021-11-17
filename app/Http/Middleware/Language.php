<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Locale;
use Request;

class Language {

	/**
	 * The availables languages.
	 *
	 * @array $languages
	 */
	protected $languages = ['es', 'en', 'pt'];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (env('APP_DEBUG')) {
			$locale = 'en';
		} else {
			$locale = Locale::acceptFromHttp(Request::server('HTTP_ACCEPT_LANGUAGE'));
		}

		$language = substr($locale, 0, 2) == 'pt' ? 'pt' : 'en';

		App::setLocale($language);

		return $next($request);
	}
}
