<?php
namespace App\Controller\Component;

use App\Model\Entity\SaveException;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Routing\Router;

class SemesterDuplicatorComponent extends Component
{
    private $controller;

    public function initialize(array $config) {
        $this->controller = $this->_registry->getController();
        $this->controller->loadModel('CoursesSemesters');
        $this->controller->loadModel('CourseSemesterProfessors');
        $this->controller->loadModel('CourseSemesterClassrooms');
    }

    public function duplicate($fromSemesterId, $toSemesterId, $settings) {
        $copyProfessors = (!empty($settings['copy_over_professors']) && $settings['copy_over_professors'] === '1');
        $copyClassrooms = (!empty($settings['copy_over_classrooms']) && $settings['copy_over_classrooms'] === '1');

        $coursesToCopy = $this->controller->CoursesSemesters->find()->where(['semester_id' => $fromSemesterId]);

        foreach ($coursesToCopy as $courseToCopy) {
            $course = $this->controller->CoursesSemesters->newEntity();
            $course->semester_id = $toSemesterId;
            $course->course_id = $courseToCopy->course_id;

            if (!$this->controller->CoursesSemesters->save($course, ['atomic' => false])) {
                throw new SaveException(__('Δεν μπόρεσε να γίνει αντιγραφή μαθήματος στο καινούργιο εξάμηνο'), $course->errors());
            }

            if ($copyProfessors) {
                $professors = $this->controller->CourseSemesterProfessors->find()->where(['course_semester_id' => $courseToCopy->id]);
                foreach ($professors as $professorToCopy) {
                    $professor = $this->controller->CourseSemesterProfessors->newEntity();
                    $professor->professor_id = $professorToCopy->professor_id;
                    $professor->course_semester_id = $toSemesterId;
                    if (!$this->controller->CourseSemesterProfessors->save($professor)) {
                        throw new SaveException(__('Δεν μπόρεσε να γίνει αντιγραφή καθηγητή στο καινούργιο εξάμηνο'), $professor->errors());
                    }
                }
            }

            if ($copyClassrooms) {
                $classrooms = $this->controller->CourseSemesterClassrooms->find()->where(['course_semester_id' => $courseToCopy->id]);
                foreach ($classrooms as $classroomToCopy) {
                    $classroom = $this->controller->CourseSemesterClassrooms->newEntity();
                    $classroom->classroom_id = $classroomToCopy->classroom_id;
                    $classroom->course_semester_id = $toSemesterId;
                    if (!$this->controller->CourseSemesterClassrooms->save($classroom)) {
                        throw new SaveException(__('Δεν μπόρεσε να γίνει αντιγραφή αίθουσας διδασκαλίας στο καινούργιο εξάμηνο'), $classroom->errors());
                    }
                }
            }
        }
    }
}