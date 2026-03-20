CREATE TABLE IF NOT EXISTS billing_records (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    provider VARCHAR(64) NOT NULL,
    product_key VARCHAR(255) NOT NULL,
    currency VARCHAR(16) NOT NULL,
    amount_cents INT NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    status VARCHAR(64) NOT NULL,
    checkout_url TEXT NOT NULL,
    meta JSON NULL,
    created_at VARCHAR(50) NOT NULL,
    updated_at VARCHAR(50) NULL,
    INDEX idx_billing_records_created_at (created_at),
    INDEX idx_billing_records_status (status),
    INDEX idx_billing_records_customer_email (customer_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
