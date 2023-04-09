1. Run `docker network create workforce-management`
2. Run `docker compose -f ./docker/docker-compose.yaml up -d`
3. Goto `http://localhost:8080/subscribe`
4. See `Aggregate App\WorkforceManagement\Domain\Organization for calling subscribe was not found using identifiers {"organizationId":"SOME_RANDOM_ULID"}`