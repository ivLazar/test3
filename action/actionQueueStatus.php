<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\QueueStatus;

class QueueController extends Controller
{
    /**
     * Обработка входящих данных и сохранение уникальной записи
     */
    public function actionSaveStatus()
    {

        // Получаем POST-данные (или из другого источника)
        $data = Yii::$app->request->post();

        // Проверка наличия всех необходимых полей
        $requiredFields = ['s_name', 'c_name', 'c_id', 'a_type', 'direction', 'activation', 'c_state', 'control'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return ['success' => false, 'message' => "Отсутствует обязательное поле: $field"];
            }
        }

        try {
            // Проверяем наличие существующей записи
            $existing = QueueStatus::findExisting();

            if (!$existing) {
                // Создаем новую запись
                $model = new QueueStatus();
                foreach ($requiredFields as $field) {
                    $model->$field = $data[$field];
                }

                if ($model->save()) {

                    return ['success' => true, 'message' => 'Запись успешно сохранена'];
                } else {
                    Yii::error('Ошибка при сохранении', __METHOD__ . "(".var_export($model->errors, true).")");
                    return ['success' => false, 'message' => 'Ошибка при сохранении', 'errors' => $model->errors];
                }
            } else {
                // Запись уже существует
                Yii::error('Такая запись уже существует', __METHOD__ . "(".var_export($data, true).")");
                return ['success' => true, 'message' => 'Такая запись уже существует'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Исключение: '.$e->getMessage()];
        }
    }
}