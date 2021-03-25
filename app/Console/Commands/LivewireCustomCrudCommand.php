<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class LivewireCustomCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:livewire:crud
    {nameOfTheClass? : The name of the class.},
    {nameOfTheModelClass? : The name of the model class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * The name of class.
     *
     * @var mixed
     */
    protected $nameOfTheClass;

     /**
     * The name of model class.
     *
     * @var mixed
     */
    protected$nameOfTheModelClass;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->file = new Filesystem();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get all parameters.
        $this->getParameters();

        // Generate the Livewire clas file.

        $this->generateLivewireCrudClassFile();

        // Generate the Livewire view file.

        $this->generateLivewireCrudViewFile();
    }

    /**
     * Funcion to get all parameters.
     *
     * @return void
     */
    protected function getParameters()
    {
       $this->nameOfTheClass = $this->argument('nameOfTheModelClass');
       $this->nameOfTheModelClass = $this->argument('nameOfTheModelClass');


       // Validate class name & model name.

       if (!$this->nameOfTheClass) {
           $this->nameOfTheClass = $this->ask('Enter class name');
       }

       if (!$this->nameOfTheModelClass) {
           $this->nameOfTheModelClass = $this->ask('Enter model name');
       }

       $this->nameOfTheClass = Str::studly($this->nameOfTheClass);
       $this->nameOfTheModelClass = Str::studly($this->nameOfTheModelClass);

     }

     /**
      * Generate livewire class file.
      *
      * @return void
      */
     protected function generateLivewireCrudClassFile()
     {
        // Set the origin  and destination for the livewire class file.

        $fileOrigin = base_path('/stubs/custom.livewire.crud.stub');
        $fileDestination = base_path('/app/Http/Livewire/' . $this->nameOfTheClass . '.php');

        if ($this->file->exists($fileDestination)) {
            $this->info('This class file already exists: '. $this->nameOfTheClass. '.php');
            return false;
        }
        // Get the origin string content of the file.

        $fileOriginalString = $this->file->get($fileOrigin);

        // Replace all strings specified in an array sequencially.

        $replaceFileOriginalString = Str::replaceArray('{{}}',
            [
                $this->nameOfTheModelClass,
                $this->nameOfTheClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                Str::kebab($this->nameOfTheClass) // Convert "FooBar" to "foo-bar"
            ],
            $fileOriginalString
        );

        // Put the content into the destination directory.

        $this->file->put($fileDestination, $replaceFileOriginalString);
        $this->info('Livewire class file created: '. $fileDestination);

     }

     /**
      * Genereate Livewire component based on Model Class.
      *
      * @return void
      */
     protected function generateLivewireCrudViewFile()
     {
         // Set the origin  and destination for the livewire class file.

        $fileOrigin = base_path('/stubs/custom.livewire.crud.view.stub');
        $fileDestination = base_path('/resources/views/livewire/' . Str::kebab($this->nameOfTheClass) . '.blade.php');

        if ($this->file->exists($fileDestination)) {
            $this->info('This view file already exists: '. Str::kebab($this->nameOfTheClass). '.blade.php');
            $this->info('Aborting file creation.');
            return false;
        }

        $this->file->copy($fileOrigin, $fileDestination);
        $this->info('Livewire view file created: ' . $fileDestination);
     }
}
