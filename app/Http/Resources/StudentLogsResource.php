<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentLogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array

    {
        return [
            'id' => $this->id,
            'name_user' => $this->name ?? 'Unknown User',
            'name_student' => $this->student ? ($this->student->first_name . ' ' . $this->student->last_name) : 'Unknown Student',
            'email_student' => $this->student->email ?? 'N/A',
            'action_label' => $this->action->label(),
            'deleted_at' => $this->deleted_at,
        ];
    }
}
