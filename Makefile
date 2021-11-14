.DEFAULT_GOAL := all
.PHONY: all test _test benchmark _benchmark pull launch clean

### Cofiguration

# IMAGES := php:8.0.0-cli php:7.4.3-cli php:7.1-cli php:7-cli php:5.4-cli php:5.3-cli
IMAGES := php:8.0.0-cli
COMMAND := php
WARMUP := 3
MIN_RUNS := 100

### Runtime

NAMESPACE != basename $$(pwd)
ARGS != find . -type d -name "Day*" -exec find {} -maxdepth 1 -name "Part*" \;
NAMES := $(foreach IMAGE, $(IMAGES), $(NAMESPACE)_$(shell echo '$(IMAGE)' | tr -dc '[:alnum:]\n\r' | tr '[:upper:]' '[:lower:]';))

### GROUPS

all : pull launch _test _benchmark clean

test : pull launch _test clean

benchmark : pull launch _benchmark clean

### TARGETS

_test:
	$(foreach ARG, $(ARGS), $(foreach NAME, $(NAMES), docker exec $(NAME) $(COMMAND) $(ARG);))

_benchmark:
	hyperfine \
		--ignore-failure \
		--warmup $(WARMUP) \
		--min-runs $(MIN_RUNS) \
		--export-markdown benchmarks_$$(date +"%Y_%m_%d_%I_%M_%p").md \
		$(foreach ARG, $(ARGS), $(foreach NAME, $(NAMES), 'docker exec $(NAME) $(COMMAND) $(ARG)'))

### HELPERS

pull:
	$(foreach IMAGE, $(IMAGES), docker pull $(IMAGE);)

launch:
	$(foreach IMAGE, $(IMAGES), docker run -d --name "$(NAMESPACE)_$(shell echo '$(IMAGE)' | tr -dc '[:alnum:]\n\r' | tr '[:upper:]' '[:lower:]')" -v $$(pwd):/app -w /app --user=1000:1000 $(IMAGE) tail -f /dev/null;)

clean:
	$(foreach NAME, $(NAMES), docker stop "$(NAME)" && docker rm "$(NAME)";)
