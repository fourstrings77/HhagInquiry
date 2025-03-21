<?php

namespace HhagInquiry\Content\Inquiry;

final class InquiryStates
{
    public const STATE_MACHINE = 'inquiry.state';
    public const STATE_OPEN = 'open';
    public const STATE_IN_PROGRESS = 'in_progress';
    public const STATE_CLOSED = 'closed';
    public const STATE_COMPLETED = 'completed';
    public const STATE_CANCELLED = 'cancelled';
}