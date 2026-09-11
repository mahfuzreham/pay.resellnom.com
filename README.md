# ResellPay

ResellPay is the payment platform under the Resellnom brand.

## Product model

### ResellPay Connect
Merchants connect their own payment provider accounts and credentials. ResellPay acts as the orchestration/integration layer.

Supported/target providers:
- bKash
- Nagad
- SurjoPay
- Stripe
- Future providers through adapters

### ResellPay Gateway
Merchants may use a ResellPay-managed payment gateway where available. Managed processing includes transaction ledgering, fees, settlement scheduling and payout configuration.

## Domains

- `pay.resellnom.com` — core payment API/gateway
- `app.resellnom.com` — merchant dashboard
- `checkout.resellnom.com` — customer checkout
- `docs.resellnom.com` — developer documentation

## Core architecture

```text
Merchant / Customer
        |
        v
   ResellPay API
        |
   Payment Router
        |
   Gateway Adapter
   /   |    |    \
 bKash Nagad SurjoPay Stripe
        |
        v
 Transaction + Ledger
        |
 Settlement Engine
        |
 Bank / Supported Payout Method
```

## Merchant gateway modes

`CLIENT_OWNED` — merchant's own provider credentials/account.

`RESELLPAY` — ResellPay-managed gateway and settlement flow.

Provider credentials must never be stored as plaintext. Use encrypted application secrets and strict access controls.

## Settlement

The managed gateway is designed around configurable settlement rules. Initial business policy: **T+3 working days**, with weekends and applicable bank holidays excluded according to the final settlement calendar and provider/banking agreement.

Settlement destinations are merchant-configured, such as an eligible bank account or supported payout method.

## Financial integrity

Use an append-only ledger for money movement. Store monetary values as integer minor units rather than floating point. Payment creation must support idempotency keys to prevent duplicate charges.

## Security baseline

- API key authentication
- Secret/API key rotation and revocation
- Webhook signatures and replay protection
- Idempotency keys
- Rate limiting
- RBAC and 2FA for privileged users
- Encrypted gateway credentials
- Audit logs
- Strict separation of merchant data

## Laravel implementation direction

Recommended bounded domains:

- Payments
- Merchants
- Gateways
- Transactions
- Ledger
- Settlements
- Refunds
- Webhooks
- API Keys

Gateway providers should implement a common `PaymentGatewayInterface` so provider-specific code remains isolated.

## Important compliance note

The ResellPay-managed gateway/settlement model must be launched only with the appropriate payment-provider, banking, regulatory, KYC/KYB, AML and funds-settlement arrangements. Software architecture does not itself establish authorization to hold or settle customer funds.
