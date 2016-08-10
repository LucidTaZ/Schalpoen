<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * @property string $question
 */
class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $answer;

    private $questionsAndAnswers = [
        ['q' => 'Hoeveel armen heeft een aap?', 'a' => ['2', 'twee']],
        ['q' => 'Hoeveel oren heeft een aap?', 'a' => ['2', 'twee']],
        ['q' => 'Uit hoeveel woorden bestaat deze vraag?', 'a' => ['6', 'zes']],
        ['q' => 'Wat is de kleur van broccoli?', 'a' => ['groen']],
        ['q' => 'Wat is de kleur van een sinaasappel?', 'a' => ['oranje']],
        ['q' => 'Welke is het grootst? Maan, Olifant, Ananas, Sinaasappel.', 'a' => ['maan']],
        ['q' => 'Welke is het kleinst? Mier, Olifant, Maan, Huis.', 'a' => ['mier']],
        // TODO: Add the following questions once parsed questioning is implemented:
        //['q' => 'Welke heeft de grootste lach? 1: ^^, 2: :P, 3: ((:', 'a' => ['3']],
        //['q' => 'Welk woord is rood? "Een ijsje is [color=red]altijd[/color] lekker."', 'a' => ['altijd']],
        //['q' => 'Welk woord is doorgestreept? "Een ijsje is [s]nooit[/s] lekker."', 'a' => ['nooit']],
    ];

    public function rules()
    {
        return [
            [['username', 'password', 'answer'], 'required'],
            [['username'], 'string', 'max' => 32],
            [['answer'], 'validateSecurityAnswer'],
        ];
    }

    public function validateSecurityAnswer($attribute, $params)
    {
        if (!$this->answerIsCorrect()) {
            $this->addError($attribute, 'Het antwoord is verkeerd');
        }
    }

    private function answerIsCorrect(): bool
    {
        $ix = Yii::$app->session->get('registration_question', 0);
        $qAndA = $this->questionsAndAnswers[$ix];
        return in_array(strtolower($this->answer), $qAndA['a']);
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Gebruikersnaam',
            'password' => 'Wachtwoord',
            'answer' => 'Antwoord',
        ];
    }

    public function createUser(): bool
    {
        if ($this->validate()) {
            $user = new User;
            $user->username = $this->username;
            $user->displayName = $this->username;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            if (!$user->save()) {
                $this->addErrors($user->errors); // Copy over errors like username duplicate
                return false;
            }
            return Yii::$app->user->login($user);
        }
        return false;
    }

    public function chooseRandomQuestion()
    {
        $ix = array_rand($this->questionsAndAnswers);
        Yii::$app->session->set('registration_question', $ix);
    }

    public function getQuestion(): string
    {
        $ix = Yii::$app->session->get('registration_question', 0);
        $qAndA = $this->questionsAndAnswers[$ix];
        return $qAndA['q'];
    }
}
