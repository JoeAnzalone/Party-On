BEGIN:VCALENDAR{{ "\r\n" }}
VERSION:2.0{{ "\r\n" }}
BEGIN:VEVENT{{ "\r\n" }}
URL:{{ route('event.showbykey', [$guest->key, $event->slug]) . "\r\n" }}
DTSTART:{{ date('Ymd\THis', strtotime($event->start_time)) . "\r\n" }}
UID:{{ route('event.showbykey', [$guest->key, $event->slug]) . "\r\n" }}
SUMMARY:{{ $event->title . "\r\n" }}
DESCRIPTION:Full event details at {{ route('event.showbykey', [$guest->key, $event->slug]) . "\r\n"}}
LOCATION:{{ $event->location_address . "\r\n" }}
END:VEVENT{{ "\r\n" }}
END:VCALENDAR{{ "\r\n" }}
