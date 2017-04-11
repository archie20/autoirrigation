<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResp;
use App\Microcontroller;
use Carbon\Carbon;
class VerifyIrrSystemToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if(! $request->has('token')){
    		return Response::make(['message'=>'missing authorization token',
    								'code'=>config('contants.TOKEN_ABSENT')],HttpResp::HTTP_UNAUTHORIZED);
    	}
    	
    	$token_time_issued = Microcontroller::where('token',$request->input('token'))->first();
    	
    	//create carbon date object
    	$dateDiff = Carbon::parse($token_time_issued->token_time_issued);
    	
    	//check if 3 days has passed since token issue
    	if($dateDiff->diffInDays()>3){
    		//deny the request and report back to irrigation system
    		return Response::make(['message'=>'expired token','code'=>config('constants.TOKEN_EXPIRED')],HttpResp::HTTP_UNAUTHORIZED);
    	}
        
    	
        return $next($request);
    }
}
