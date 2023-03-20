<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'title' => 'Web Development Basics',
                'slug' => 'web-development-basics',
                'icon' => 'education',
                'description' => 'Learn the basics of web development, including HTML, CSS, and JavaScript.',
                'estimated_time' => '10:00',
                'modules' => [
                    [
                        'title' => 'HTML Basics',
                        'description' => 'Learn the basics of HTML, including tags, attributes, and document structure.',
                    ],
                    [
                        'title' => 'CSS Basics',
                        'description' => 'Learn the basics of CSS, including selectors, properties, and stylesheets.',
                    ],
                    [
                        'title' => 'JavaScript Basics',
                        'description' => 'Learn the basics of JavaScript, including variables, functions, and events.',
                    ]
                ]
            ],
            [
                'title' => 'Python for Data Science',
                'slug' => 'python-for-data-science',
                'icon' => 'education',
                'description' => 'Get started with Python and learn how to use it for data analysis and visualization.',
                'estimated_time' => '10:00',
                'modules' => [
                    [
                        'title' => 'Python Basics',
                        'description' => 'Learn the basics of Python, including variables, data types, and control structures.',
                    ],
                    [
                        'title' => 'NumPy Basics',
                        'description' => 'Learn the basics of NumPy, including arrays, indexing, and broadcasting.',
                    ],
                    [
                        'title' => 'Matplotlib Basics',
                        'description' => 'Learn the basics of Matplotlib, including creating plots, adding labels, and customizing styles.',
                    ]
                ]
            ],
            [
                'title' => 'Introduction to Machine Learning',
                'slug' => 'introduction-to-machine-learning',
                'icon' => 'education',
                'description' => 'Learn the basics of machine learning and how to use it to make predictions and classifications.',
                'estimated_time' => '10:00',
                'modules' => [
                    [
                        'title' => 'Supervised Learning',
                        'description' => 'Learn about supervised learning, including classification and regression.',
                    ],
                    [
                        'title' => 'Unsupervised Learning',
                        'description' => 'Learn about unsupervised learning, including clustering and dimensionality reduction.',
                    ],
                    [
                        'title' => 'Model Evaluation and Selection',
                        'description' => 'Learn how to evaluate and select machine learning models for different tasks.',
                    ]
                ]
            ],
        ];

        foreach ($courses as $item) {
            $course = Course::where('title', $item['title'])->first();

            if(!$course){
                $course = Course::create($item);
            }

            foreach ($item['modules'] as $moduleData) {
                $module = Module::create([
                    'title' => $moduleData['title'],
                    'description' => $moduleData['description'],
                    'course_id' => $course->id,
                ]);
            }
        }
    }


}
