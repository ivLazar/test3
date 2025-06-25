<?php
class QueueStatus {
    public function actionSaveQueueStatus(array $data)
    {
        // Предполагается, что в массиве есть все необходимые поля:
        // s_name, c_name, c_id, a_type, direction, activation, c_state, control

        // Ищем существующую запись по уникальным полям (которые определяют дубликат)
        //отсуcтвие uid - не есть хорошо, даже добавление нового пользоателя - это 4%, что ведет к увечеличению к время/трудозатратам - не эффективно
        $existing = QueueStatus::findExisting([
            // Ищем по полям, чтобы найти дубликат:
            // например:
            //'s_name' => $data['s_name'],
            //'c_name' => $data['c_name'],
            //'c_id'   => $data['c_id'],
            //'a_type'=> $data['a_type'],
            //'direction'=> $data['direction'],
            //'activation'=> $data['activation'],
            //'c_state'=> $data['c_state'],
            //'control'=> $data['control']
            // Именование полей/свойств такое себе без должного документирования
            [
                's_name' =>$data['s_name'],
                'c_name' =>$data['c_name'],
                'c_id' =>$data['c_id'],
                'a_type' =>$data['a_type'],
                'direction' =>$data['direction'],
                'activation' =>$data['activation'],
                'c_state' =>$data['c_state'],
                'control' =>$data['control']
            ]
        ]);

        if (!$existing) {
            // Создаем новую запись только если не существует
            $model = new QueueStatus();
            foreach ($data as $key => $value) {
                if (property_exists($model, $key)) {
                    $model->$key = $value;
                }
            }

            if (!$model->save()) {
                // Обработка ошибок при сохранении (логирование или исключение), логирование эффективнее
                throw new \Exception('Ошибка при сохранении QueueStatus: '.json_encode($model->errors));
            }
        }
    }
}