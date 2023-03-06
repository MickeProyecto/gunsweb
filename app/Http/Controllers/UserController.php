<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function signup(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'lastname'=>'required',
            'phone'=>'required | unique:users',
            'photo'=>'required',
            'dni'=>'required ',
            'date_birth'=>'required',
            'direccion'=>'required',
            'email'=>'required | email | unique:users',
            'password'=>'required',
            'id_role'=>'required',
        ]);

        $user = new User();
        $user->name=$request->name;
        $user->lastname=$request->lastname;
        $user->phone=$request->phone;
        $user->photo=$request->photo;
        $user->dni=$request->dni;
        $user->date_birth=$request->date_birth;
        $user->direccion=$request->direccion;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->id_role=$request->id_role;
        $user->save();
        //Auth::login($user);
        return response()->json([
            'message' => 'Successfully created user!'
        ]);

    }
    public function login(Request $request)
    {
        $request->validate([
            "dni" => "required",
            "password" => "required"
        ]);
        $user=user::where("dni","=",$request->dni)->first();
        if(isset($user->id)){
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "status"=>1,
                    "message"=>"Usuario logeado exitosamente",
                    "access_token"=>$token
                ]);
            }else{
                return response()->json([
                    "status"=>0,
                    "message"=>"La contraseña del usuario no es correcta",
                ]);
            }
        }else{
            return response()->json([
                "status"=>0,
                "message"=>"El usuario no esta registrado",
            ]);
        }
    }
    public function userprofile(){
        return response()->json([
            "status"=>0,
            "message"=>"Acerca del perfil del usuario",
            "data"=>auth()->user()
        ]);
    }
    public function update(Request $request, $id){
        $user_id=auth()->user()->id;
        if(user::where(["id"=>$user_id])->exists()){
            $update = user::find($user_id);
            $update->password=Hash::make($request->password);
            $update->save();
            return response()->json([
                "status"=>1,
                "message"=>"Actualizado correctamente",
            ]);
        }else{
            return response()->json([
                "status"=>1,
                "message"=>"No se pùdo actucalizar",
            ]);
        }
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            "status"=>1,
            "message"=>"cierre de session",
        ]);
    }
}
