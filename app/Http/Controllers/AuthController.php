<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\PayloadFactory;

class AuthController extends Controller
{

    public function __construct(User $user, Subscribers $subscribers) {
        $this->middleware('auth:api', ['except' => ['login', 'register','createNewToken']]);
        $this->user = $user;
        $this->subscribers = $subscribers;
    }




    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        

        return $this->createNewToken($token);
    }

    public function register(Request $request ) {
        $validator = Validator::make($request->all(), [
           
            'password' => 'required|string|min:4',
            'name' => 'required|string|min:2',
            'last_name' => 'required|string|min:5',
            'email' => 'required|email|unique:users',
            'division' => 'required|string',
            'middle_name' => 'required|string',
            'company_name' =>'string',
            'inn' => '',
            'phone' =>'',
            'town' => 'required|string',
            'address_line1' => 'required|string',
            'address_line2' => 'string',
            'address_line3' => 'string',
            'postal_code' => 'numeric',
            

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

     /*  $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)],

        ));*/

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]),
        );
       
        

        $subscribers = new Subscribers ;
        $subscribers->users_id = $user->id;
        $subscribers->name = $request->input('name');
        $subscribers->last_name = $request->input('last_name');
        $subscribers->middle_name = $request->input('middle_name');
        $subscribers->company_country = $request->input('company_country');
        $subscribers->company_name = $request->input('company_name');
        $subscribers->inn = $request->input('inn');
        $subscribers->phone = $request->input('phone');
        $subscribers->email = $request->input('email');
        $subscribers->division = $request->input('division');
        $subscribers->postal_code =$request->input('postal_code');
        $subscribers->address_line1 =$request->input('address_line1');
        $subscribers->town =$request->input('town');
        $subscribers->save();




        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            'subscribers' =>$subscribers,
            
        ], 201);
    }

    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh() {
        return $this->createUserToken(auth()->refresh());
    }

    public function createUserToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 990,
            'user' => auth()->user()->id,

        ]);
    }
    protected function createNewToken2($token){


        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->id,

        ]);

    }
    protected function createNewToken($token)
    {
       $customClaims = ['user_id' => auth()->user()->id, 'role' => auth()->user()->role];

        $payload = JWTFactory::make($customClaims);

        return response()->json([
            'access_token' => $token  ,
            'payload' =>$payload,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->id,



        ]);
    }

    private function User($id)
    {
        $user = User::find(1);

        $payload = JWTFactory::sub($user->id)
            ->myCustomString('role' ,auth()->user()->role)
            ->myCustomObject($user)
            ->make();
        
        $token = JWTAuth::encode($payload);
    }


}
