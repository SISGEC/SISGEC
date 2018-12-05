<li class="bdB peers ai-c jc-sb fxw-nw">
    <a class="td-n p-20 peers fxw-nw mR-20 peer-greed c-grey-900 content" data-toggle="collapse" href="#appointment-{{ $appointment->id }}" role="button" aria-expanded="false" aria-controls="appointment-{{ $appointment->id }}">
        <div class="peer mR-15">
            <i class="fa fa-fw fa-clock c-red-500"></i>
        </div>
        <div class="peer description">
            <span class="fw-600">{{ $appointment->title ?? "" }}</span>
            <div class="c-grey-600">
                <span class="c-grey-700">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($appointment->date))->diffForHumans() }} - </span>
                <i>{{ $appointment->description ?? "" }}</i>
            </div>
        </div>
    </a>
    <div class="peers mR-15">
        <div class="peer">
            <a href="javascript:" data-tippy="{{ __("global.edit_appointment") }}" data-tippy-arrow="true" data-tippy-placement="right" data-appointment_id="{{ $appointment->id === 1 ? "1" : $appointment->id }}" class="appointment_edit_button td-n c-deep-purple-500 cH-blue-500 fsz-md p-5">
                <i class="ti-pencil"></i>
            </a>
        </div>
        <div class="peer">
            <a href="{{ route("medical_appointments.remove", ["id" => $appointment->id]) }}" data-tippy="{{ __("global.delete_appointment") }}" data-tippy-arrow="true" data-tippy-placement="right" class="td-n c-red-500 cH-blue-500 fsz-md p-5 remove_this">
                <i class="ti-trash"></i>
            </a>
        </div>
    </div>
</li>
<li class="bdB peers ai-c jc-sb fxw-nw">
    <div class="collapse" id="appointment-{{ $appointment->id }}">
        <div class="td-n p-20 peers fxw-nw mR-20 peer-greed c-grey-900">
            <ul class="appointment-inputs-list">
                <li>
                    <strong>{{ __("global.title") }}:</strong> {{ $appointment->title }}
                </li>
                <li>
                    <strong>{{ __("global.date") }}:</strong> {{ $appointment->date->format("d/m/Y h:i a") }}
                </li>
                <li>
                    <strong>{{ __("global.description") }}:</strong><br/>{{ $appointment->description }}
                </li>
            </ul>
        </div>
    </div>
</li>