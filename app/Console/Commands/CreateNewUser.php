<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Rules\CustomPassword;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\throwException;

class CreateNewUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that creates interactively a new user.';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $questions = [
                'firstname' => 'Enter first name',
                'lastname' => 'Enter last name',
                'email' => 'Enter a valid email address',
                'username' => 'Enter username',
                'password' => 'Enter password'
            ];

            $input = [];

            foreach ($questions as $key => $question) {
                $input[$key] = $this->askWithValidation($question, function ($value) use ($key) {
                    return $this->validateInput($key, $value);
                });
            }
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

            event(new Registered($user));

            if (is_object($user)) {
                echo 'User with username: ' . $user->username . ' was created successfully!' . PHP_EOL;
            }
        } catch (Exception $exception) {
            throwException($exception);
        }

        return Command::SUCCESS;
    }

    /**
     * @param $question
     * @param null $validator
     * @param null $default
     * @return mixed
     */
    public function askWithValidation($question, $validator = null, $default = null) {
        return $this->output->ask($question, $default, $validator);
    }

    /**
     * @param string $attribute
     * @param $value
     * @throws Exception
     */
    public function validateInput(string $attribute, $value) {
        $rules = [
            'email' => ['required', 'email','required','email','unique:App\Models\User,email'],
            'username' => ['required', 'string', 'max:20', 'min:3', 'unique:App\Models\User,username'],
            'firstname' => ['required','alpha','min:3','max:20'],
            'lastname' => ['required','alpha','min:3','max:20'],
            'password' => ['required', 'max:16',
                CustomPassword::min(6)->mixedCase()->symbols()->numbers()->letters()->uncompromised(3)],
        ];

        $validator = Validator::make([$attribute => $value],[$attribute => $rules[$attribute]]);

        if ($validator->fails()) {
            throw new Exception(implode(PHP_EOL, $validator->errors()->get($attribute)));
        }

        return $value;
    }
}
