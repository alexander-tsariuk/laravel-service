<?php

namespace Modules\Dashboard\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\OurWorks\Entities\OurWork;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectImages;
use Modules\Slider\Entities\Slider;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeWebpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:webp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

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
    public function handle()
    {
        $this->info('Начинаю поиск...');

        $this->warn("Поиск слайдов.");
        $this->makeWebpForSlides();
//        $this->warn("Поиск услуг.");
//        $this->makeWebpForServices();
//        $this->warn("Поиск проектов.");
//        $this->makeWebpForProjects();
//        $this->warn("Поиск галереи проектов.");
//        $this->makeWebpForProjectsGallery();
    }

    private function makeWebpForProjectsGallery() {
        $items = ProjectImages::all();
        $this->info("Найдено галерей проектов: ".$items->count());

        if(!empty($items)) {
            foreach ($items as $item) {
                $this->info("Галерея проекта #" . $item->id . '. Поиск изображений...');

                if (!$item->path) {
                    $this->info("Галерея проекта #" . $item->id . '. Изображение не найдено!');
                } else {
                    $image = $item->path;

                    $imageName = explode('/', $image);

                    $imageName = end($imageName);

                    $extension = "";

                    if (!empty($imageName)) {
                        $imageName = explode('.', $imageName);
                        if (isset($imageName[1]) && !empty($imageName[1])) {
                            $extension = $imageName[1];
                        }

                        if (isset($imageName[0]) && !empty($imageName[0])) {
                            $imageName = $imageName[0];
                        }
                    }

                    $source = Storage::disk('public')->get($image);

                    $image = Image::make($source)->encode('webp', 75);

                    if (!Storage::disk('public')->exists('/project-images/' . $item->projectId . '/' . $imageName . '.webp')) {
                        $imagePath = Storage::disk('public')->path('/project-images/' . $item->projectId . '/' . $imageName . '.webp');

                        $imagePath = preg_replace("#(\/\/)#", "/", $imagePath);

                        $image->save($imagePath);

                        $this->info("Галерея проекта #" . $item->id . '. Изображение Webp сгенерировано.');
                    } else {
                        $this->info("Галерея проекта #" . $item->id . '. Изображение Webp уже существует. Пропускаем.');
                    }
                }
            }
        }
    }

    private function makeWebpForProjects() {
        $items = Project::all();
        $this->info("Найдено проектов: ".$items->count());

        if(!empty($items)) {
            foreach ($items as $item) {
                $this->info("Проект #" . $item->id . '. Поиск изображений...');

                if (!$item->image) {
                    $this->info("Проект #" . $item->id . '. Изображение не найдено!');
                } else {
                    $image = $item->image;

                    $imageName = explode('/', $image);

                    $imageName = end($imageName);

                    $extension = "";

                    if (!empty($imageName)) {
                        $imageName = explode('.', $imageName);
                        if (isset($imageName[1]) && !empty($imageName[1])) {
                            $extension = $imageName[1];
                        }

                        if (isset($imageName[0]) && !empty($imageName[0])) {
                            $imageName = $imageName[0];
                        }
                    }

                    $source = Storage::disk('public')->get($image);

                    $image = Image::make($source)->encode('webp', 75);

                    if (!Storage::disk('public')->exists('/project/' . $item->id . '/' . $imageName . '.webp')) {
                        $imagePath = Storage::disk('public')->path('/project/' . $item->id . '/' . $imageName . '.webp');

                        $imagePath = preg_replace("#(\/\/)#", "/", $imagePath);

                        $image->save($imagePath);

                        $this->info("Проект #" . $item->id . '. Изображение Webp сгенерировано.');
                    } else {
                        $this->info("Проект #" . $item->id . '. Изображение Webp уже существует. Пропускаем.');
                    }
                }
            }
        }
    }

    private function makeWebpForServices() {
        $services = OurWork::all();
        $this->info("Найдено услуг: ".$services->count());

        if(!empty($services)) {
            foreach ($services as $service) {
                $this->info("Услуга #" . $service->id . '. Поиск изображений...');

                if (!$service->image) {
                    $this->info("Услуга #" . $service->id . '. Изображение не найдено!');
                } else {
                    $image = $service->image;

                    $imageName = explode('/', $image);

                    $imageName = end($imageName);

                    $extension = "";

                    if (!empty($imageName)) {
                        $imageName = explode('.', $imageName);
                        if (isset($imageName[1]) && !empty($imageName[1])) {
                            $extension = $imageName[1];
                        }

                        if (isset($imageName[0]) && !empty($imageName[0])) {
                            $imageName = $imageName[0];
                        }
                    }

                    $source = Storage::disk('public')->get($image);

                    $image = Image::make($source)->encode('webp', 90);

                    if (!Storage::disk('public')->exists('/ourservice/' . $service->id . '/' . $imageName . '.webp')) {
                        $imagePath = Storage::disk('public')->path('/ourservice/' . $service->id . '/' . $imageName . '.webp');

                        $imagePath = preg_replace("#(\/\/)#", "/", $imagePath);

                        $image->save($imagePath);

                        $this->info("Услуга #" . $service->id . '. Изображение Webp сгенерировано.');
                    } else {
                        $this->info("Услуга #" . $service->id . '. Изображение Webp уже существует. Пропускаем.');
                    }
                }
            }
        }
    }

    private function makeWebpForSlides() {
        $slides = Slider::all();

        $this->info("Найдено слайдов: ".$slides->count());

        if(!empty($slides)) {
            foreach ($slides as $slide) {
                $this->info("Слайд #".$slide->id.'. Поиск изображений...');

                if(!$slide->image) {
                    $this->info("Слайд #".$slide->id.'. Изображение не найдено!');
                } else {
                    $image = $slide->image;

                    $imageName = explode('/', $image);

                    $imageName = end($imageName);

                    $extension = "";

                    if(!empty($imageName)) {
                        $imageName = explode('.', $imageName);
                        if(isset($imageName[1]) && !empty($imageName[1])) {
                            $extension = $imageName[1];
                        }

                        if(isset($imageName[0]) && !empty($imageName[0])) {
                            $imageName = $imageName[0];
                        }
                    }

                    $source = Storage::disk('public')->get($image);

                    $image = Image::make($source)->encode('webp', 20);

                    if(!Storage::disk('public')->exists('/slider/'.$slide->id.'/'.$imageName.'.webp')) {
                        $imagePath = Storage::disk('public')->path('/slider/'.$slide->id.'/'.$imageName.'.webp');

                        $imagePath = preg_replace("#(\/\/)#", "/", $imagePath);

                        $image->save($imagePath);

                        $this->info("Слайд #".$slide->id.'. Изображение Webp сгенерировано.');
                    } else {
                        $this->info("Слайд #".$slide->id.'. Изображение Webp уже существует. Пропускаем.');
                    }

                }


            }
        }


    }


}
