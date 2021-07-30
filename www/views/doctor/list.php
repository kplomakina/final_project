<? include_once('views/common/header.php'); ?>
<div class="wrap-content doctors-back">
    <div class="container">
        <div class="heading">
            <div class="row">
                <div class="col-md-6">
                    <div class="heading-first_half">
                        <div class="doctors-heading">Команда<br>
                            <div class="doctors-heading_name">VetYourPet</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="heading-second_half">
                        <div class="doctors-heading_desc">это команда лучших ветеринарных врачей, специалистов по&nbsp;лечению домашних животных в&nbsp;Санкт-Петербурге и&nbsp;области. Наши врачи ежедневно повышают свой уровень знаний о&nbsp;болезнях животных, принимают участие в&nbsp;программах в&nbsp;качестве слушателей, лекторов, ведут мастер-классы, изучают зарубежную литературу и&nbsp;сотрудничают с&nbsp;иностранными коллегами.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <? foreach($doctors as $doctor): ?>
            <div class="col-md-4 doctor-div" data-toggle="modal" data-target="#exampleModalCenter<?= $doctor['doctor_id']; ?>">
                <div class="col doctor-pic_div">
                    <img class="doctor-pic" src="/<?= IMG . $doctor['doctor_pic_name']; ?>" alt="">
                </div>
                <div class="col doctor-desc">
                    <div class="doctor-name">
                        <?= $doctor['doctor_name']; ?>
                    </div>
                    <div class="doctor-qualification">
                        <?= $doctor['qualification_type_name']; ?>
                    </div>
                    <div class="doctor-experience">
                        Опыт профессиональной деятельности: с&nbsp;<?= $doctor['doctor_experience_years']; ?> года
                    </div>
                </div>
            </div>
                <div class="modal doctor-modal fade" id="exampleModalCenter<?= $doctor['doctor_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="doctor-modal-content">
                            <div class="modal-header">
                                <div class="doctor-modal_heading" id="exampleModalLongTitle"><i class="fa fa-user-md"></i> <?= $doctor['doctor_name']; ?></div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="doctor-span" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="doctor-services-title">Перечень оказываемых услуг:</div>
                                <? foreach($doctorsServices as $doctorServices): ?>
                                    <? foreach($services as $service): ?>
                                        <?= (($doctorServices['doctors_services_doctor_id'] == $doctor['doctor_id']) && ($doctorServices['doctors_services_service_id'] == $service['service_id'])) ? '<i class="fa fa-heartbeat"></i>  '.$service['service_name'] . '<br>' : ''; ?>
                                    <? endforeach; ?>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>

        </div>
    </div>
</div>
<? include_once('views/common/footer.php'); ?>
