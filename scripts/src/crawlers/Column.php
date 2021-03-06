<?php

inc("/src/util/Stringer.php");
/**
 * Represents a column to be imported by a regular expression
 */
class Column {
	private $name; //Name of column
	private $replace; //what peices will be replaced with what other peices
	private $remove; //WHat peices of the column value to remove
	private $normalize; //true:normalize, false:leave as is
	private $toMd5; //name of column to which the value will be md5 hashed.
	private $copyPreRemove; //name of column which the value will be copied to before removing
	private $copyPreNormalize; //name of column which the value will be copied to before normalizing, after removing
	private $escape; //true:escape the current string, false: leave as is
	private $append; //append this to the value

	/**
	 * Constructor.
	 */
	public function __construct($name) {
		$this->name = $name;
		$this->replace = [];
		$this->remove = [];
		$this->normalize = false;
		$this->toMd5 = false;
		$this->copyPreRemove = false;
		$this->copyPreNormalize = false;
		$this->escape = false;
		$this->append = '';
	}

	/****
	 * Setters
	 */
	public function setName             (      $name   ) { $this->name             = $name;    }
	public function setReplace          (array $replace) { $this->replace          = $replace; }
	public function addReplace          (      $replace) { $this->replace[]        = $replace; }
	public function clearReplace        (              ) { $this->replace          = [];       }
	public function setRemove           (array $remove ) { $this->remove           = $remove;  }
	public function addRemove           (      $rem    ) { $this->remove[]         = $rem;     }
	public function clearRemove         (              ) { $this->remove           = [];       }
	public function setNormalize        (      $norm   ) { $this->normalize        = $norm;    }
	public function setToMd5            (      $name   ) { $this->toMd5            = $name;    }
	public function setCopyPreRemove    (      $name   ) { $this->copyPreRemove    = $name;    }
	public function setCopyPreNormalize (      $name   ) { $this->copyPreNormalize = $name;    }
	public function setEscape           (      $esc    ) { $this->escape           = $esc;     }
	public function setAppend           (      $append ) { $this->append           = $append;  }

	/****
	 * Getters
	 */
	public function getName             () { return $this->name;             }
	public function getReplace          () { return $this->replace;          }
	public function getRemove           () { return $this->remove;           }
	public function getNormalize        () { return $this->normalize;        }
	public function getToMd5            () { return $this->toMd5;            }
	public function getCopyPreRemove    () { return $this->copyPreRemove;    }
	public function getCopyPreNormalize () { return $this->copyPreNormalize; }
	public function getEscape           () { return $this->escape;           }
	public function getAppend           () { return $this->append;           }

	/**
	 * Process a a value for the given column.
	 */
	public function processValue(&$record, $value) {
		if ($this->escape) {
			$value = stripcslashes($value);
		}
		if ($this->copyPreRemove) {
			$record->{$this->copyPreRemove} = $value;
		}
		if ($this->replace) {
			$value = Stringer::replace($value, $this->replace);
		}
		if ($this->remove) {
			$value = Stringer::remove($value, $this->remove);
		}
		if ($this->copyPreNormalize) {
			$record->{$this->copyPreNormalize} = $value;
		}
		if ($this->normalize) {
			$value = Stringer::normalize($value);
		}
		if ($this->append) {
			$value .= $this->append;
		}
		if ($this->toMd5) {
			$record->{$this->toMd5} = md5($value);
		}
		$record->{$this->name} = $value;
		return $value;
	}
}

?>