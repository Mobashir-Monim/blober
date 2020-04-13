@extends('layouts.app')

@section('content')
    <div class="card mb-2">
        <div class="card-header">Dashboard <span class="float-right" style="font-size: 1.2em"><a href="{{ route('users.edit') }}"><i class="fa fas fa-cog"></i></a></span></div>

        <div class="card-body">
            <div class="card card-rounded">
                <div class="card-body card-rounded body-bg">
                    <div class="row">
                        <div class="col-md-2 text-center my-auto border-right">
                            <i class="fa fas fa-user-circle fa-5x text-dark"></i>
                        </div>
                        <div class="col-md-10 my-auto">
                            <div class="row mb-1 border-bottom"><div class="col-md-12"><b>{{ $user->name }}</b></div></div>
                            <div class="row mb-1"><div class="col-md-12">Status: <b>{{ strtoupper($user->highestRole()->name) }}</b></div></div>
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Member Since: <b>{{ Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</b>
                                        </div>
                                        <div class="col-md-6 text-muted text-right font-italic mt-auto" style="font-size: 0.8em">
                                            Last Activity: {{ $user->lastActivity }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($user->hasRole('student'))
        <div class="card">
            <div class="card-header">Student Info</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 pl-4">
                        <div class="card body-bg card-rounded mb-2">
                            <div class="card-body body-bg card-rounded">
                                @foreach ($user->student->analytics() as $key => $val)
                                    <div class="row border-bottom mb-1">
                                        <div class="col-md-8 pl-0">{{ $key }}</div>
                                        <div class="col-md-4 text-right pr-0">{{ $val }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-center">
                            <i class="text-muted" style="font-size: 0.8em"><strong>Note:</strong> Please click on legend items on chart to hide/show item(s)</i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card body-bg card-rounded">
                            <div class="card-body body-bg card-rounded">
                                <profile-student
                                    pointsset="{{ json_encode($dataset['points']) }}"
                                    labelsset="{{ json_encode($dataset['dates']) }}"
                                    errorsset="{{ json_encode($dataset['errors']) }}"
                                    trialsset="{{ json_encode($dataset['trials']) }}"
                                    queriesset="{{ json_encode($dataset['queries']) }}"
                                    ></profile-student>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
