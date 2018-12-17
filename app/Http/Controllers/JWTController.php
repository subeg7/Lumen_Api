<?
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class YourController extends Controller{
        /**
         * Create a new token.
         *
         * @param  \App\User   $user
        * @return string
        */
        protected function jwt(User $user) {
            $payload = [
                'iss' => "lumen-jwt",                     // Issuer of the token
                'sub' => $user->id,                      // Subject of the token
                'iat' => time(),                        // Time when JWT was issued.
                'exp' => time() +  config('jwt.app.ttl')// Expiration time
            ];
            return JWT::encode($payload, config('jwt.app.secret'));
       }

       /**
         * Authenticate a user and return the token if the provided credentials are correct.
         *
         * @param  \App\User   $user
         * @return mixed
         */
        public function authenticateUser(Request $request) {
              $this->validate($request, [
              'email'     => 'required|email',
              'password'  => 'required'
         ]);

        // Find the user by email
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->json([
                'error' => 'Email does not exist.'
            ], 400);
        }
        // Verify the password and generate the token
        if (Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }
        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }
}
