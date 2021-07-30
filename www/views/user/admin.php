<? include_once('views/common/header.php'); ?>
<div class="wrap-content reg-back">
        <div class="container">
            <div class="row">
               <? if(!$userIsAdmin): ?>
                   <div class="reg-error no-rights">
                       <h6>Для просмотра информации необходимо авторизоваться</h6>
                   </div>
               <? else: ?>
               <div class="col-3">
                    <div class="admin_menu nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="admin_menu-item nav-link active" id="v-pills-service-types-tab" data-toggle="pill" href="#v-pills-service-types" role="tab" aria-controls="v-pills-service-types" aria-selected="true">Описание групп услуг</a>
                        <a class="admin_menu-item nav-link" id="v-pills-add-service-type-tab" data-toggle="pill" href="#v-pills-add-service-type" role="tab" aria-controls="v-pills-add-service-type" aria-selected="false">Добавить группу услуг</a>
                        <a class="admin_menu-item nav-link" id="v-pills-delete-service-type-tab" data-toggle="pill" href="#v-pills-delete-service-type" role="tab" aria-controls="v-pills-delete-service-type" aria-selected="false">Удалить группу услуг</a>
                        <a class="admin_menu-item nav-link" id="v-pills-service-tab" data-toggle="pill" href="#v-pills-service" role="tab" aria-controls="v-pills-service" aria-selected="false">Редкатрирование и удаление услуг</a>
                        <a class="admin_menu-item nav-link" id="v-pills-add-service-tab" data-toggle="pill" href="#v-pills-add-service" role="tab" aria-controls="v-pills-add-service" aria-selected="false">Добавление услуги</a>
                        <a class="admin_menu-item nav-link" id="v-pills-doctors-tab" data-toggle="pill" href="#v-pills-doctors" role="tab" aria-controls="v-pills-doctors" aria-selected="false">Редактирование информации о докторах</a>
                        <a class="admin_menu-item nav-link" id="v-pills-add-doctor-tab" data-toggle="pill" href="#v-pills-add-doctor" role="tab" aria-controls="v-pills-add-doctor" aria-selected="false">Добавление доктора</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-service-types" role="tabpanel" aria-labelledby="v-pills-service-types-tab">
                            <? if(!empty($answers)): ?>
                                <? foreach($answers as $answer): ?>
                                    <div class="reg-error">
                                        <?= $answer; ?>
                                    </div>
                                <? endforeach; ?>
                            <? endif; ?>
                            <form action="" method="POST">
                                <? foreach($serviceGroups as $serviceGroup): ?>
                                   <div class="admin_service_type_group">
                                        <div>
                                            <label for="service_type_id<?= $serviceGroup['service_type_id']; ?>" class="form-label"></label>
                                            <input type="hidden" class="form-control" name="service_type_id<?= $serviceGroup['service_type_id']; ?>" id="service_type_id<?= $serviceGroup['service_type_id']; ?>" value="<?= $serviceGroup['service_type_id']; ?>">
                                        </div>
                                        <div class="admin-title">Укрупненная группа услуг <?= $serviceGroup['service_type_id']; ?>:</div>
                                        <div>
                                            <label for="service_type_name<?= $serviceGroup['service_type_id']; ?>" class="form-label"></label>
                                            <input type="text" class="form-control" name="service_type_name<?= $serviceGroup['service_type_id']; ?>" id="service_type_name<?= $serviceGroup['service_type_id']; ?>" value="<?= $serviceGroup['service_type_name']; ?>">
                                        </div>
                                        <div>
                                            <label for="service_type_desc<?= $serviceGroup['service_type_id']; ?>" class="form-label"></label>
                                            <textarea class="form-control" id="service_type_desc<?= $serviceGroup['service_type_id']; ?>" name="service_type_desc<?= $serviceGroup['service_type_id']; ?>" rows="3"><?= $serviceGroup['service_type_desc']; ?></textarea>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                                <button class="admin-btn">Сохранить изменения</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-add-service-type" role="tabpanel" aria-labelledby="v-pills-add-service-type-tab">
                            <form action="" method="POST">
                               <div class="admin_service_type_group">
                                    <div>
                                        <label for="add-service_type_name" class="form-label"></label>
                                        <input type="text" class="form-control" name="add-service_type_name" id="add-service_type_name" placeholder="Название укрупненной группы">
                                    </div>
                                    <div>
                                        <label for="add-service_type_desc" class="form-label"></label>
                                        <textarea class="form-control" id="add-service_type_desc" name="add-service_type_desc" rows="3" placeholder="Описание укрупненной группы"></textarea>
                                    </div>
                                </div>
                                <button class="admin-btn">Добавить</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-delete-service-type" role="tabpanel" aria-labelledby="v-pills-delete-service-type-tab">
                            <form action="" method="POST">
                               <div class="admin_service_type_group add-margin-top">
                                    <div>
                                        <select class="form-control" name="delete-service-type">
                                            <? foreach($serviceGroups as $serviceGroup): ?>
                                                <option value="<?= $serviceGroup['service_type_id']; ?>">
                                                    <?= $serviceGroup['service_type_name']; ?>
                                                </option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <button class="admin-btn">Удалить</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-service" role="tabpanel" aria-labelledby="v-pills-service-tab">
                            <form action="" method="POST">
                                <? foreach($services as $service): ?>
                                       <div class="admin_service_type_group add-margin-bottom">
                                            <div>
                                                <label for="service_id<?= $service['service_id']; ?>" class="form-label"></label>
                                                <input type="hidden" class="form-control" name="service_id<?= $service['service_id']; ?>" id="service_id<?= $service['service_id']; ?>" value="<?= $service['service_id']; ?>">
                                            </div>
                                            <div class="admin-title">Укрупненная группа услуг 
                                                <select class="form-control" name="service-service-type<?= $service['service_id']; ?>">
                                                    <? foreach($serviceGroups as $serviceGroup): ?>
                                                        <option value="<?= $serviceGroup['service_type_id']; ?>" <?= ($serviceGroup['service_type_id'] == $service['service_service_type_id']) ? 'selected' : ''; ?>>
                                                            <?= $serviceGroup['service_type_name']; ?>
                                                        </option>
                                                    <? endforeach; ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="service_name<?= $service['service_id']; ?>" class="form-label"></label>
                                                <input type="text" class="form-control" name="service_name<?= $service['service_id']; ?>" id="service_name<?= $service['service_id']; ?>" value="<?= $service['service_name']; ?>">
                                            </div>
                                            <div>
                                                <label for="service_price<?= $service['service_id']; ?>" class="form-label"></label>
                                                <input type="number" min="0" max="99999" class="form-control" name="service_price<?= $service['service_id']; ?>" id="service_price<?= $service['service_id']; ?>" value="<?= $service['service_price']; ?>">
                                            </div>
                                            <div class="admin-title">Услуга удалена 
                                                <select class="form-control" name="service-is-deleted<?= $service['service_id']; ?>">
                                                    <option value="0" <?= (0 == $service['service_is_deleted']) ? 'selected' : ''; ?>>Нет</option>
                                                    <option value="1" <?= (1 == $service['service_is_deleted']) ? 'selected' : ''; ?>>Да</option>
                                                </select>
                                            </div>
                                        </div>
                                <? endforeach; ?>
                                <button class="admin-btn">Сохранить измененния</button>
                            </form>
                          </div>
                        <div class="tab-pane fade" id="v-pills-add-service" role="tabpanel" aria-labelledby="v-pills-add-service-tab">
                            <form action="" method="POST">
                             <div class="admin_service_type_group add-margin-top">
                                  <div>
                                        <select class="form-control" name="add-service">
                                            <? foreach($serviceGroups as $serviceGroup): ?>
                                                <option value="<?= $serviceGroup['service_type_id']; ?>">
                                                    <?= $serviceGroup['service_type_name']; ?>
                                                </option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="add-service_name" class="form-label"></label>
                                        <input type="text" class="form-control" name="add-service_name" id="add-service_name" placeholder="Название услуги">
                                    </div>
                                    <div>
                                        <label for="add-service_price" class="form-label"></label>
                                        <input type="number" min="0" max="99999" placeholder="00000.00" class="form-control" name="add-service_price" id="add-service_price" value="">
                                    </div>
                                </div>
                                <button class="admin-btn">Добавить</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-doctors" role="tabpanel" aria-labelledby="v-pills-doctors-tab">
                            <form action="" method="POST">
                                <? foreach($doctors as $doctor): ?>
                                       <div class="admin_service_type_group add-margin-bottom">
                                            <div>
                                                <label for="doctor-id<?= $doctor['doctor_id']; ?>" class="form-label"></label>
                                                <input type="hidden" class="form-control" name="doctor-id<?= $doctor['doctor_id']; ?>" id="doctor-id<?= $doctor['doctor_id']; ?>" value="<?= $doctor['doctor_id']; ?>">
                                            </div>
                                            <div>
                                                <label for="doctor-name<?= $doctor['doctor_id']; ?>" class="form-label"></label>
                                                <input type="text" class="form-control" name="doctor-name<?= $doctor['doctor_id']; ?>" id="doctor-name<?= $service['doctor_id']; ?>" value="<?= $doctor['doctor_name']; ?>">
                                            </div>
                                            <div class="admin-title">Квалификация 
                                                <select class="form-control" name="doctor-qualification-type<?= $doctor['doctor_id']; ?>">
                                                    <? foreach($qualificationTypes as $qualificationType): ?>
                                                        <option value="<?= $qualificationType['qualification_type_id']; ?>" <?= ($qualificationType['qualification_type_id'] == $doctor['doctor_qualification_type_id']) ? 'selected' : ''; ?>>
                                                            <?= $qualificationType['qualification_type_name']; ?>
                                                        </option>
                                                    <? endforeach; ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="doctor-experience<?= $doctor['doctor_id']; ?>" class="form-label"></label>
                                                <input type="number" min="1930" max="2050" class="form-control" name="doctor-experience<?= $doctor['doctor_id']; ?>" id="doctor-experience<?= $doctor['doctor_id']; ?>" value="<?= $doctor['doctor_experience_years']; ?>">
                                            </div>
                                            <div>
                                                <label for="doctor-pic<?= $doctor['doctor_id']; ?>" class="form-label"></label>
                                                <input type="text" class="form-control" name="doctor-pic<?= $doctor['doctor_id']; ?>" id="doctor-pic<?= $doctor['doctor_id']; ?>" value="<?= $doctor['doctor_pic_name']; ?>">
                                            </div>
                                            <div class="admin-title">Доктор удален 
                                                <select class="form-control" name="doctor-is-deleted<?= $doctor['doctor_id']; ?>">
                                                    <option value="0" <?= (0 == $doctor['doctor_is_deleted']) ? 'selected' : ''; ?>>Нет</option>
                                                    <option value="1" <?= (1 == $doctor['doctor_is_deleted']) ? 'selected' : ''; ?>>Да</option>
                                                </select>
                                            </div>
                                            <div class="admin-title">Оказываемые услуги 
                                                <select class="form-control" multiple name="doctor-services<?= $doctor['doctor_id']; ?>[]">
                                                   <? foreach($services as $service): ?>
                                                         <option value="<?= $service['service_id']; ?>"
                                                         <? foreach($doctorsServices as $doctorServices): ?>
                                                          <?= (($doctorServices['doctors_services_doctor_id'] == $doctor['doctor_id']) && ($doctorServices['doctors_services_service_id'] == $service['service_id'])) ? 'selected' : ''; ?>
                                                         <? endforeach; ?>
                                                           >
                                                               <?= $service['service_name']; ?>
                                                         </option>
                                                    <? endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <? endforeach; ?>
                                <button class="admin-btn">Сохранить измененния</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-add-doctor" role="tabpanel" aria-labelledby="v-pills-add-add-doctor-tab">
                            <form action="" method="POST">
                             <div class="admin_service_type_group">
                                  <div>
                                       <label for="add-doctor-name" class="form-label"></label>
                                       <input type="text" class="form-control" name="add-doctor-name" id="add-doctor-name" placeholder="ФИО">
                                    </div>
                                    <div class="admin-title">Квалификация 
                                        <select class="form-control" name="add-doctor-qualification-type">
                                            <? foreach($qualificationTypes as $qualificationType): ?>
                                                <option value="<?= $qualificationType['qualification_type_id']; ?>">
                                                    <?= $qualificationType['qualification_type_name']; ?>
                                                </option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>   
                                    <div>
                                        <label for="add-doctor-experience" class="form-label"></label>
                                        <input type="number" min="1930" max="2050" class="form-control" name="add-doctor-experience" id="add-doctor-experience" placeholder="2000 - год начала профессиональной деятельности" value="">
                                    </div>
                                    <div>
                                        <label for="add-doctor-pic" class="form-label"></label>
                                        <input type="text" class="form-control" name="add-doctor-pic" id="add-doctor-pic" placeholder="doctor_7.jpg">
                                    </div>
                                    <div class="admin-title">Оказываемые услуги 
                                        <select class="form-control" multiple name="add-doctor-services[]">
                                            <? foreach($services as $service): ?>
                                                <option value="<?= $service['service_id']; ?>">
                                                    <?= $service['service_name']; ?>
                                                </option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <button class="admin-btn">Добавить</button>
                            </form>
                        </div>
                    </div>
                </div>
                <? endif; ?>
            </div>
        </div>
</div>
<? include_once('views/common/footer.php'); ?>
