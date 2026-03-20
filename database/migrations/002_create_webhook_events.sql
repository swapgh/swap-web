CREATE TABLE IF NOT EXISTS webhook_events (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    provider VARCHAR(64) NOT NULL,
    event_type VARCHAR(255) NOT NULL,
    session_id VARCHAR(255) NOT NULL,
    payload JSON NOT NULL,
    recorded_at VARCHAR(50) NOT NULL,
    INDEX idx_webhook_events_provider (provider),
    INDEX idx_webhook_events_session_id (session_id),
    INDEX idx_webhook_events_recorded_at (recorded_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
