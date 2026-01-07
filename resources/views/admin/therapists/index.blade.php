@extends('layouts.admin.app')

@section('title', 'Therapists')

@section('breadcrumb')
@foreach ( $breadcrumbs as $crumb)
@if ($crumb['url'])
<li class="breadcrumb-item">
    <a href="{{ $crumb['url'] }}" class="text-dark">{{ $crumb['title'] }}</a>
</li>
@else
<li class="breadcrumb-item">
    {{ $crumb['title'] }}
</li>
@endif
@endforeach
@endsection

@section('page-heading', 'Therapists')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')


@section('content')

<div
    x-data="{
            loading: false,
            form: {
                user_id: null,
            }
        }">



    @if($errors->any())
    <div class="alert alert-danger rounded-3 mb-4">
        {{ $errors->first() }}
    </div>

    @elseif(session('approve_therapist_success'))
    <div class="alert alert-success rounded-3 mb-4">
        {{ session('approve_therapist_success') }}
    </div>
    @endif



    <table class="table table-hover">
        <thead>
            <tr>
                <th class="p-3">Email</th>
                <th class="p-3">Name</th>
                <th class="p-3">Email Verified At</th>
                <th class="p-3">Approved At</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ( $therapists as $therapist)
            <tr>
                <td class="p-3">{{ $therapist->email }}</td>
                <td class="p-3">{{ $therapist->name }}</td>
                <td class="p-3">{{ $therapist->email_verified_at ?? 'Unverified' }}</td>
                <td class="p-3">{{ $therapist->approved_at ?? 'Unapproved' }}</td>

                {{-- Dropdown Container --}}
                <td class="p-3">
                    {{-- Dropdown --}}
                    <div class="dropdown">
                        {{-- Dropdown Button --}}
                        <button class="btn btn-sm btn-secondary rounded-3 px-3" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>

                        {{-- Dropdown Menu--}}
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">

                            @if(!$therapist->approved_at)
                            {{-- Approve --}}
                            <li>
                                <form
                                    :action="`{{ url('admin/therapists') }}/${form.user_id}`"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    {{-- Hidden User ID --}}
                                    <input type="hidden" name="id" x-model="form.user_id">

                                    <button type="submit" class="dropdown-item text-success"
                                        onclick="return confirm('Are you sure you want to approve this person as therapist?');"
                                        @click="form.user_id = @js($therapist->id);">
                                        <i class="bi bi-check-circle"></i> Approve
                                    </button>
                                </form>
                            </li>

                            {{-- Decline --}}
                            <li>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to decline this client?');">
                                        <i class="bi bi-x-circle"></i> Decline
                                    </button>
                                </form>
                            </li>

                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            @endif

                            <li>
                                <a href="" class="dropdown-item">
                                    <i class="bi bi-eye me-2"></i>View
                                </a>
                            </li>



                        </ul>
                    </div>
                </td>
            </tr>

            @empty
            <tr>
                <td class="text-center" colspan="5">No Therapist found.</td>
            </tr>
            @endforelse

        </tbody>
    </table>

</div>

@endsection