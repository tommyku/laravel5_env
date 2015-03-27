<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\File;

class EnvCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'env:switch';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Switch between environments by changing .env file';

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
	 * @return mixed
	 */
	public function fire()
	{
        $envPath = base_path().'/.env';
        $envir = $this->laravel['env'];
        if ($this->option('save')) {
            // save current env
            $targetPath = base_path().'/.'.$envir.'.env';
            File::put($targetPath, File::get($envPath), true);
            $this->info('Environmental config file <comment>.'.$envir.'.env</comment> saved');
        } else {
            // switch to a different env
            $targetEnv = $this->argument('env');
            $targetPath = base_path().'/.'.$targetEnv.'.env';
            if (!File::exists($targetPath)) {
                $this->error('Cannot switch to environment:<info> '.$targetEnv.' </info>because<info> .'.$targetEnv.'.env </info>doesn\'t exist');
                return;
            }
            File::put($envPath, File::get($targetPath), true);
            $this->info('Successfully switched from <comment>'.$envir.'</comment> to <comment>'.$targetEnv.'</comment>.');
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['env', InputArgument::OPTIONAL, 'The environment name to switch to'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['save', null, InputOption::VALUE_NONE, 'Save the current .env to a \$APP_ENV.env file before switching.', null],
		];
	}

}
